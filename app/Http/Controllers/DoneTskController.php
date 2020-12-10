<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class DoneTskController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,Task $task)
    {
        $task->update([
           'done'=> !$task->done
        ]);
        return response()->json([
            'sucsses'=>true,
            'data'=>$task->toArray(),
        ],200);
    }
}

