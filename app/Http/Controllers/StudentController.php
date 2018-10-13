<?php
 
 namespace App\Http\Controllers;


 use Illuminate\Support\Facades\DB;
 class StudentController extends Controller
 {
 	public function test1()
 	{
 		$students=DB::select('select * from student');
 		var_dump($students);
 	}
 }