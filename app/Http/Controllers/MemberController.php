<?php

 namespace App\Http\Controllers;
use App\Member;
 class MemberController extends Controller
 {
 	public function info($id)
 	{


 		return Member::getMember();


 		/*return 'member-info-id-'.$id;*/
 		/*return view('member/info',[
 			'name'=>'邂逅彡Your',
 			'age'=>20 
 		]);*/
 	}
 }


 CREATE TABLE IF NOT EXISTS student(
 	`id` INT AUTO_INCREMENT PRIMARY KEY,
 	`name` VARCHAR(255) NOT NULL DEFAULT '' COMMENT '姓名',
 	`age` TINYINT UNSIGNED NOT NULL DEFAULT 0 COMMENT '年龄',
 	`sex` TINYINT UNSIGNED NOT NULL DEFAULT 10 COMMENT '性别',
 	`created_at` INT NOT NULL DEFAULT 0 COMMENT '新增时间',
 	`update_at` INT NOT NULL DEFAULT 0 COMMENT '修改时间'
 )ENGINE=InnoDB DEFAULT CHARSET=UTF8 AUTO_INCREMENT=1001 COMMENT'学生表';