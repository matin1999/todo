<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Task;
use Illuminate\Http\Request;

class NoteActionController extends Controller
{

    /**
     * @param Task $task
     * @param Note $note ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Task $task, $note)
    {
        Note::withTrashed()->find($note)->restore();

        return $this->back($task);
    }
    public function terminate(Task $task,$note)
    {
        Note::withTrashed()->find($note)->forceDelete();

        return $this->back($task);

    }

    private function back($task)
    {
        return redirect()->route('tasks.show',$task);
    }
}
