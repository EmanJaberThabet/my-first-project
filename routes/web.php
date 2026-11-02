<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about',function(){
    $name = 'Eman';
    $departments=['1'=>'Tichnical',
    '2'=>'Finanial',
    '3'=>'Sales',
    ];
   // return view('about')->with('name',$name);
  // return view('about',['name'=>$name]);
    return view ('about',compact('name','departments'));
});
Route::post('/about',function(){
    $name = $_POST['name'];
    $departments=['1'=>'Tichnical',
    '2'=>'Finanial',
    '3'=>'Sales',
    ];
    return view('about',compact('name','departments'));

});
Route::get('tasks',function(){
    return view ('tasks');

});
Route::post('create',function(){
    //فقط نضمن عملية الاضافة
    $task_name=$_POST['name'];
    DB::table('tasks')->insert(['name' => $task_name]);
    return view ('tasks');
});
