<?php

namespace Tests\Feature;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\TaskLists;
use App\Models\Tasks;
use App\Models\Labels;
use App\Models\Users;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    // Use the database trait to reset the database after tests

    public function testGetTaskLists()
    {
        $user = Users::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->get('/api/getTaskLists');
        $response->assertStatus(200);
        $response->assertJsonStructure(['task_lists']);
    }

    public function testGetTasks()
    {
        $user = Users::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->get('/api/getTasks');
        $response->assertStatus(200);
        $response->assertJsonStructure(['tasks']);
    }

    public function testGetLabels()
    {
        $user = Users::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->get('/api/getLabels');
        $response->assertStatus(200);
        $response->assertJsonStructure(['labels']);
    }

    public function testGetAssignee()
    {
        $user = Users::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->get('/api/getAssignee');
        $response->assertStatus(200);
        $response->assertJsonStructure(['assignee']);
    }

    public function testAddNewTaskList()
    {
        $user = Users::factory()->create();
        $this->actingAs($user, 'sanctum');

        $highestPosition = TaskLists::max('position');
        $position = $highestPosition + 1;

        $taskListData = [
            'name' => 'Test Task List',
            'position' => $position,
            'is_completed' => false,
            'is_trashed'=> false,
            'open_tasks'=> 0,
            'completed_tasks'=> 0,
        ];

        $response = $this->post('/api/addNewTaskList', $taskListData);
        $response->assertStatus(201);
        $response->assertJsonStructure(['status', 'taskList']);
    }

    public function testDeleteTaskList()
    {
        $user = Users::factory()->create();
        $this->actingAs($user, 'sanctum');

        $taskList = TaskLists::factory()->create();

        $response = $this->put('/api/deleteTaskList', ['id' => $taskList->id]);
        $response->assertStatus(202);
        $response->assertJsonStructure(['status', 'taskList']);
    }

    public function testCompleteTaskList()
    {
        $user = Users::factory()->create();
        $this->actingAs($user, 'sanctum');

        $taskList = TaskLists::factory()->create();

        $response = $this->patch("/api/completeTaskList/{$taskList->id}");
        $response->assertStatus(202);
        $response->assertJsonStructure(['status', 'task_list', 'tasks']);
    }

    public function testSortTaskList()
    {
        $user = Users::factory()->create();
        $this->actingAs($user, 'sanctum');

        $taskList1 = TaskLists::factory()->create();
        $taskList2 = TaskLists::factory()->create();

        $task1 = Tasks::factory()->create(['task_list_id' => $taskList1->id]);
        $task2 = Tasks::factory()->create(['task_list_id' => $taskList2->id]);

        $requestData = [
            $taskList1->id => [$task2->id, $task1->id], // Swap the order of tasks within taskList1
        ];

        $requestData = Arr::except($requestData, ['assignee', 'labels']);

        $response = $this->patch('/api/sortTaskList', $requestData);
        $response->assertStatus(202);
        $response->assertJsonStructure(['status']);
    }

    public function testLogin()
    {
        $user = Users::factory()->create([
            'password' => Hash::make('your_actual_password_here'),
        ]);

        $userData = [
            'username' => $user->username,
            'password' => 'your_actual_password_here',
        ];

        $response = $this->post('/api/login', $userData);
        $response->assertStatus(200);
        $response->assertJsonStructure(['message', 'user', 'token', 'token_expiration']);
    }
}
