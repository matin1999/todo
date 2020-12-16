<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Tag;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags=Tag::all()->pluck('name','id');
        return view('tasks.create')->with('tags',$tags);
    }

    /**
     * Store a newly created resource in storage.
     * @var $task Task
     * @param CreateTaskRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTaskRequest $request)
    {

        $task = auth()->user()->tasks()->create([
            'title' => $request->title,
            'done' => $request->get('done', false),
            'date' => Carbon::createFromTimestampMs($request->altField),
        ]);
        if ($request->has('tags')){
            $task->tags()->sync($request->get('tags'));
        }

        return redirect()->action('TaskController@index')
            ->with('status', 'کار با موفقیت ساخته شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        if ($task->user_id == auth()->id())
        return view('tasks.show')
            ->with('task',$task);
        else
            return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        if ($task->user_id != auth()->id())
            return abort(404);
//        $task->update([
//            'title' => $request->get('title'),
//            'done' => $request->get('done')
//        ]);
//
//        $task->update($request->all());
        else
        $task->update($request->validated());

        return redirect()->action('TaskController@index')
            ->with('status', 'کار با موفقیت بروزرسانی شد.');
    }

    /**
     * Remove the specified resource from .
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->action('TaskController@index')
            ->with('status', "کار با موفقیت.حذف شد.");
    }

    public function delete(Task $task)
    {
        $task->delete();


        return redirect()->action('TaskController@index')
            ->with('status', "کار با موفقیت.حذف شد.");

    }
}
