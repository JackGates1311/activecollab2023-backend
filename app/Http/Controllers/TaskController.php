<?php

namespace App\Http\Controllers;

use App\Models\Labels;
use App\Models\TaskLists;
use App\Models\Tasks;
use App\Models\Users;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        $task_lists = TaskLists::all();
        $tasks = Tasks::all();
        $labels = Labels::all();
        $users = Users::all();

        $modified_tasks = $tasks->map(function ($task) {
            $taskData = $task->toArray();
            $taskData['labels'] = $task->labels->pluck('id')->toArray();
            $taskData['assignee'] = $task->assignees->pluck('id')->toArray();
            return $taskData;
        });

        return response()->json(['task_lists' => $task_lists, 'tasks' => $modified_tasks,
            'labels' => $labels, 'users' => $users]);
    }

    public function show($id): JsonResponse
    {
        $task = Tasks::find($id);

        $label_ids = $task->labels->pluck('id')->toArray();
        $assignee_ids = $task->assignees->pluck('id')->toArray();

        return response()->json(['labels' => $label_ids, 'assignee' => $assignee_ids]);
    }
}
