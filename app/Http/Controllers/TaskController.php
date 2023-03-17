<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $kanbanData = [];
        $projects = Project::pluck('title', 'id');
        if(!empty($request->p) && $request->p != 'all'){
            $tasks = Task::where('project_id', $request->p)->orderBy('priority')->get();
        }else{
            $tasks = Task::orderBy('priority')->get();
        }
        $badge = null;
        foreach ($tasks as $index => $task) {
            foreach (config('constants.task_status') as $key => $status) {
                if($key == $task->status){
                    $badge =  $status['badge'];
                    $badgeName =  $status['name'];
                }
            }
            array_push($kanbanData, [
                'p' => $index + 1,
                'id' => 'task_id_'.$task->id,
                'title' => '<div class="item-wrap d-flex"><h6>'.$task->title.'</h6><ul style="margin-left: auto">
                <li class="d-inline-block"><span class="badge bg-'.$badge.'">'.$badgeName.'</span></li>
                <li class="d-inline-block"><a href="javascript:void(0)" class="btn btn-xs btn-secondary" onClick="modifyTask('.$task->id.');">Edit</a></li>
                <li class="d-inline-block"><a href="javascript:void(0)" class="btn btn-xs btn-danger" onClick="removeTask('.$task->id.');" >Remove</a></li></ul></div>',
                'class' => ["$badge"]
            ]);
        }
        return view('tasks.index', compact('projects','kanbanData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create ()
    {
        $projects = Project::pluck('title', 'id');
        return view('tasks.form', compact('projects'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task;
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status ?? 1;
        $task->priority = Task::max('priority') + 1;
        $task->project_id = $request->project_id;
        $task->created_by = auth()->id();
        $task->save();

        return redirect()->route('task.index')->with('alert-success', 'Record has been stored successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        // dd($request->id);
        // $task = Task::find($request->id);
        $projects = Project::pluck('title', 'id');
        return view('tasks.form', compact('task', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();

        return redirect()->route('task.index')->with('alert-success', 'Record has been updated successfully.');

    }

    public function changePriority(Request $request)
    {
        $taskIDs = $request->input('tids');
        foreach ($taskIDs as $index => $id) {
            $task = Task::find($id);
            $task->update(['priority' => $index + 1]);
        }

        return response()->json(['status' => 200, 'message' => 'Task priorities updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return response()->json(['status' => 200, 'message' => 'Task priorities updated!']);
        } catch (\Exception $ex) {
            return response()->json(['status' => 400, 'message' => 'Something went wrong!']);
        }
    }
}
