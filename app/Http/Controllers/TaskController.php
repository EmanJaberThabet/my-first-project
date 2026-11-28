<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class TaskController extends Controller
{
    public function index() {
       // $tasks =DB::table('tasks')->get();
         $tasks = Task::all();
        return view ('tasks', compact('tasks'));
    }


    public function create(Request $request){
       $validated = $request->validate([
        'name' => 'required|max:10|min:3'
       ]);
       $task_name=$request->name;
       // DB::table('tasks')->insert(['name' => $task_name]);
       $task = new Task;
       $task->name =  $task_name;
       $task->save();

        return redirect()->back();
    }


    public function destroy($id) {
    // DB::table('tasks')->where('id', $id)->delete();
    $task = Task::find($id);
    if ($task) {
        $task->delete();
    }

    return redirect()->back();
}


    public function edit($id){
       // $task= DB::table('tasks')->where('id' , $id)->first();
       // $tasks= DB::table('tasks')->get();

       $task = Task::find($id);
    $tasks = Task::all();
        return view('tasks', compact('task','tasks'));
    }


    public function update(Request $request){

        $validated = $request->validate([
        'name' => 'required|max:10|min:3'
       ]);
       // DB::table('tasks')->where('id','=',$id)->update(['name'=>$_POST['name']]);

       $task = Task::find($request->id);
        $task->name = $request->name;
        $task->save();
        return redirect('tasks');
    }

}
