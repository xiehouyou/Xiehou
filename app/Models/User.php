<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;
use App\Notifications\ResetPassword;
use Auth;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function gravatar($size='100')
    {
        $hash=md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->activation_token = str_random(30);
        });
    }
     public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
    /*在用户模型中，指明一个用户拥有多条微博。*/
    public function statuses()
    {
        return $this->hasMany(Status::class);
    }
    /*将当前用户发布过的所有微博从数据库中取出，并根据创建时间来倒序排序。*/
    public function feed()
    {
        $user_ids = Auth::user()->followings->pluck('id')->toArray();
        array_push($user_ids, Auth::user()->id);
        return Status::whereIn('user_id', $user_ids)
                              ->with('user')
                              ->orderBy('created_at', 'desc');
       /* return $this->statuses()
                    ->orderBy('created_at', 'desc');*/
    }
    public function followers()
    {
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }

    public function follow($user_ids)
    {
        if(!is_array($user_ids)){
            $user_ids=compact('user_ids');
        }
        $this->followings()->sync($user_ids,false);
    }
    public function unfollow($user_ids)
    {
        if(!is_array($user_ids)){
            $user_ids=compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }
    /*用contains方法来判断用户B是否包含在用户A的关注人列表上*/
      public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }
}
