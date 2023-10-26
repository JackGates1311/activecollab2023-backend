<?php

namespace App\Http\Controllers;

use App\Models\Labels;
use App\Models\TaskLists;
use App\Models\Tasks;
use App\Models\Users;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class TaskController extends Controller
{
    public function show($id): JsonResponse
    {
        $task = Tasks::find($id);

        $label_ids = $task->labels->pluck('id')->toArray();
        $assignee_ids = $task->assignees->pluck('id')->toArray();

        return response()->json(['labels' => $label_ids, 'assignee' => $assignee_ids]);
    }

    public function getTaskLists(): JsonResponse
    {
        $task_lists = TaskLists::all();
        return response()->json(['task_lists' => $task_lists]);
    }

    public function getTasks(): JsonResponse
    {
        $tasks = Tasks::all();

        $modified_tasks = $tasks->map(function ($task) {
            $taskData = $task->toArray();
            $taskData['labels'] = $task->labels->pluck('id')->toArray();
            $taskData['assignee'] = $task->assignees->pluck('id')->toArray();
            return $taskData;
        });

        return response()->json(['tasks' => $modified_tasks]);
    }

    public function getLabels(): JsonResponse
    {
        $labels = Labels::all();
        return response()->json(['labels' => $labels]);
    }

    public function getAssignee(): JsonResponse
    {
        $assignee = Users::all();
        return response()->json(['assignee' => $assignee]);
    }

    public function addNewTask(Request $request):JsonResponse
    {
        // manage logic for labels and assignee there!

        try {
            $task = Tasks::create($request->except('assignee', 'labels'));
            return response()->json(['status' => 'OK', 'task' => $task], 201);
        } catch (Exception $e) {
            return response()->json(['status' => $e->getMessage()], 500);
        }
    }

    public function addNewTaskList(Request $request): JsonResponse
    {
        try {
            $task_list = TaskLists::create($request->all());
            return response()->json(['status' => 'OK', 'taskList' => $task_list], 201);
        } catch (Exception $e) {
            return response()->json(['status' => $e->getMessage()], 500);
        }
    }

    public function deleteTaskList(Request $request): JsonResponse
    {
        $task_list = TaskLists::find($request->all()['id']);

        try {
            $task_list->update($request->except('created_at', 'updated_at'));
            return response()->json(['status' => 'Accepted', 'taskList' => $task_list], 202);
        } catch (Exception $e) {
            return response()->json(['status' => $e->getMessage()], 500);
        }
    }

    public function completeTaskList($id): JsonResponse
    {
        try {
            $task_list = TaskLists::find($id);

            $task_list->is_completed = true;

            $task_list->update($task_list->toArray());

            $tasks = $task_list->tasks;

            foreach ($tasks as $task)
            {
                $task->is_completed = true;
                $task->completed_on = Carbon::now();
                $task->update($task->toArray());
            }

            return response()->json(['status' => 'Accepted', 'task_list' => $task_list, 'tasks' => $tasks], 202);
        } catch (Exception $e) {
            return response()->json(['status' => $e->getMessage()], 500);
        }
    }

    public function sortTaskList(Request $request): JsonResponse
    {
        try {
            $keys = array_keys($request->all());
            $key = $keys[0];
            $order = [];

            if (isset($request->all()[$key])) {
                $order = $request->all()[$key];
            }

            $task_list = TaskLists::find($key);

            $tasks = $task_list->tasks;

            $sortedTasks = collect($tasks)->sortBy(function ($task) use ($order) {
                return array_search($task['id'], $order);
            })->values()->all();

            foreach ($sortedTasks as $i=>$sortedTask)
            {
                $task = Tasks::find($sortedTask['id']);
                $task->position = $i;
                $task->update($task->toArray());
            }

            return response()->json(['status' => 'OK', 'tasks' => $tasks], 202);
        } catch (Exception $e) {
            return response()->json(['status' => $e->getMessage()], 500);
        }
    }
}
