<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /************************************************************************
    *Task index page
    *************************************************************************/
    public function index()
    {        
        //Fetch Tasks
        $tasks = Task::paginate(5);
        return view('task.index', compact('tasks'));
    }

    /************************************************************************
    *Task Add view page
    *************************************************************************/
    public function add()
    {        
        return view('task.create');
    }

    /************************************************************************
    *Task store function
    *************************************************************************/
    public function store(Request $request)
    {        
        //Validate input values
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date',
            'progress' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //Save Task details
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        $task->progress = $request->progress;
        $task->save();

        return redirect()->route('task.index')->with('success', 'Task created successfully.');
    }

    /************************************************************************
    *Task show view page
    *************************************************************************/
    public function show($id)
    {        
        $task = Task::find($id);
        return view('task.show', compact('task',));
    }

    /************************************************************************
    *Task edit view page
    *************************************************************************/
    public function edit($id)
    {        
        $task = Task::find($id);
        return view('task.edit', compact('task',));
    }

    /************************************************************************
    *Task update function
    *************************************************************************/
    public function update(Request $request)
    {        
        //Validate input values
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required|date',
            'progress' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //Save Task details
        $task = Task::where('id', $request->task_id)->first();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        $task->progress = $request->progress;
        $task->is_completed = $request->status;
        $task->save();

        return redirect()->route('task.index')->with('success', 'Task updated successfully.');
    }

    /************************************************************************
    *Task delete function
    *************************************************************************/
    public function delete($id)
    {        
        Task::where('id', $id)->delete();
        return response()->json(['success'=>'Task deleted successfully.']);
    }
}
