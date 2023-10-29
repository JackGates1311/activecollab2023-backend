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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        DB::beginTransaction();

        try {
            $task = Tasks::create($request->except('assignee', 'labels'));

            foreach($request->toArray()['labels'] as $label)
            {
                $task->labels()->attach($label);
            }

            foreach($request->toArray()['assignee'] as $user)
            {
                $task->assignees()->attach($user);
            }

            DB::commit();
            return response()->json(['status' => 'OK', 'task' => $task], 201);
        } catch (Exception $e) {
            DB::rollBack();
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

    public function findMovedId($original_array, $updated_array) {
        foreach ($original_array as $list_id => $original_tasks) {
            $diff = array_diff($original_tasks, $updated_array[$list_id]);
            if (!empty($diff)) {
                return reset($diff);
            }
        }
        return -1;
    }

    public function sortTaskList(Request $request): JsonResponse
    {
        try {
            $keys = array_keys($request->all());

            if(isset($keys[1])) {
                if($keys[1] == 'isCompletedItem') {
                    $id = $request->all()[$keys[1]];

                    $completed_task = Tasks::find($id[0]);
                    $completed_task->is_completed = true;
                    $completed_task->completed_on = Carbon::now();
                    $completed_task->update($completed_task->toArray());

                } else {
                    $tasks_a = TaskLists::find($keys[0])->tasks;
                    $tasks_b = TaskLists::find($keys[1])->tasks;

                    $original_array = [
                        $keys[0] => array_column($tasks_a->toArray(), 'id'),
                        $keys[1] => array_column($tasks_b->toArray(), 'id'),
                    ];

                    $updated_array = $request->all();

                    $moved_task_id = $this->findMovedId($original_array, $updated_array);

                    $moved_task = Tasks::find($moved_task_id);

                    if($moved_task->task_list_id == $keys[0]) {
                        $moved_task->task_list_id = $keys[1];
                    } else {
                        $moved_task->task_list_id = $keys[0];
                    }

                    $moved_task->update($moved_task->toArray());

                    $tasks_a_new = TaskLists::find($keys[0])->tasks;
                    $tasks_b_new = TaskLists::find($keys[1])->tasks;

                    $this->sortTasks($tasks_a_new, $updated_array[$keys[0]]);
                    $this->sortTasks($tasks_b_new, $updated_array[$keys[1]]);
                }

                return response()->json(['status' => 'Accepted'], 202);

            } else if (isset($keys[0])) {
                $order = $request->all()[$keys[0]];

                $task_list = TaskLists::find($keys[0]);

                $tasks = $task_list->tasks;

                $sorted_tasks = collect($tasks)->sortBy(function ($task) use ($order) {
                    return array_search($task['id'], $order);
                })->values()->all();

                foreach ($sorted_tasks as $i=>$sorted_task)
                {
                    $task = Tasks::find($sorted_task['id']);
                    $task->position = $i;
                    $task->update($task->toArray());
                }

                return response()->json(['status' => 'OK', 'tasks' => $tasks], 202);
            } else {
                return response()->json(['status' => 'Keys are not valid'], 500);
            }

        } catch (Exception $e) {
            return response()->json(['status' => $e->getMessage()], 500);
        }
    }

    private function sortTasks($tasks, $order)
    {
        $sorted_tasks = collect($tasks)->sortBy(function ($task) use ($order) {
            return array_search($task['id'], $order);
        })->values()->all();

        foreach ($sorted_tasks as $i => $sorted_task) {
            $task = Tasks::find($sorted_task['id']);
            $task->position = $i;
            $task->update($task->toArray());
        }
    }

    public function login(Request $request): JsonResponse
    {
        $validateUser = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validateUser->fails()) {
            return response()->json(['message' => 'Username or Password is not provided',
                'error' => $validateUser->errors()], 401);
        }

        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Username or Password is incorrect',
                'error' => 'Username or Password is incorrect'], 401);
        }


        $user = (new Users)->where('username', $request->all()['username'])->firstOrFail();


        $token = $user->createToken('api_token')->plainTextToken;
        $token_expiration = Carbon::now()->addMinutes(config('sanctum.expiration'));

        return response()->json(['message' => "Login successful",
            'user' => $user,
            'token' => $token,
            'token_expiration' => $token_expiration]);
    }
}
