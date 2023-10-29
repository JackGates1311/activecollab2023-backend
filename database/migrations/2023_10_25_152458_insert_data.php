<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('task_lists')->insert([
            [
                'id' => 1,
                'name' => 'To Do',
                'open_tasks' => 7,
                'completed_tasks' => 0,
                'position' => 0,
                'is_completed' => false,
                'is_trashed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'In Progress',
                'open_tasks' => 3,
                'completed_tasks' => 0,
                'position' => 1,
                'is_completed' => false,
                'is_trashed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Blocked',
                'open_tasks' => 0,
                'completed_tasks' => 0,
                'position' => 2,
                'is_completed' => false,
                'is_trashed' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Ready for review',
                'open_tasks' => 3,
                'completed_tasks' => 1,
                'position' => 3,
                'is_completed' => false,
                'is_trashed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Testing',
                'open_tasks' => 1,
                'completed_tasks' => 1,
                'position' => 4,
                'is_completed' => false,
                'is_trashed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        DB::table('tasks')->insert([
            [
                'id' => 1,
                'name' => 'Designing and implementing UI components',
                'is_completed' => false,
                'task_list_id' => 1,
                'position' => 0,
                'start_on' => null,
                'due_on' => '2023-01-03 00:00:00',
                //'labels' => json_encode([]),
                'open_subtasks' => 0,
                'comments_count' => 0,
                //'assignee' => json_encode([]),
                'is_important' => false,
                'completed_on' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Creating and implementing design system components',
                'is_completed' => false,
                'task_list_id' => 1,
                'position' => 1,
                'start_on' => '2023-05-08 00:00:00',
                'due_on' => '2023-09-10 00:00:00',
                //'labels' => json_encode([]),
                'open_subtasks' => 2,
                'comments_count' => 7,
                //'assignee' => json_encode([1]),
                'is_important' => false,
                'completed_on' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Implementing UI animations and transitions',
                'is_completed' => false,
                'task_list_id' => 1,
                'position' => 2,
                'start_on' => null,
                'due_on' => null,
                //'labels' => json_encode([]),
                'open_subtasks' => 0,
                'comments_count' => 0,
                //'assignee' => json_encode([]),
                'is_important' => false,
                'completed_on' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Developing and integrating UI libraries and frameworks',
                'is_completed' => false,
                'task_list_id' => 1,
                'position' => 3,
                'start_on' => '2023-05-08 00:00:00',
                'due_on' => '2023-09-10 00:00:00',
                //'labels' => json_encode([1,2,3,4,5,6,7,8]),
                'open_subtasks' => 2,
                'comments_count' => 7,
                //'assignee' => json_encode([1]),
                'is_important' => false,
                'completed_on' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Designing and integrating user flow and interactions',
                'is_completed' => false,
                'task_list_id' => 1,
                'position' => 4,
                'start_on' => '2023-05-08 00:00:00',
                'due_on' => '2023-09-10 00:00:00',
                //'labels' => json_encode([1, 2, 3, 4, 5, 6, 7, 8]),
                'open_subtasks' => 2,
                'comments_count' => 7,
                //'assignee' => json_encode([1]),
                'is_important' => false,
                'completed_on' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'Make API calls',
                'is_completed' => false,
                'task_list_id' => 1,
                'position' => 5,
                'start_on' => null,
                'due_on' => null,
                //'labels' => json_encode([1, 2, 3]),
                'open_subtasks' => 2,
                'comments_count' => 7,
                //'assignee' => json_encode([]),
                'is_important' => false,
                'completed_on' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'name' => 'Create mobile app',
                'is_completed' => false,
                'task_list_id' => 1,
                'position' => 6,
                'start_on' => null,
                'due_on' => null,
                //'labels' => json_encode([]),
                'open_subtasks' => 1,
                'comments_count' => 0,
                //'assignee' => json_encode([3]),
                'is_important' => false,
                'completed_on' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'name' => 'Building and integrating UI kits, Implementing responsive design',
                'is_completed' => false,
                'task_list_id' => 2,
                'position' => 0,
                'start_on' => '2019-05-08 00:00:00',
                'due_on' => '2019-09-10 00:00:00',
                //'labels' => json_encode([1, 2]),
                'open_subtasks' => 2,
                'comments_count' => 0,
                //'assignee' => json_encode([3, 2, 1]),
                'is_important' => false,
                'completed_on' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'name' => 'Implementing UI localization and internationalization, Implementing redesign of translation',
                'is_completed' => false,
                'task_list_id' => 2,
                'position' => 1,
                'start_on' => null,
                'due_on' => null,
                //'labels' => json_encode([4,3]),
                'open_subtasks' => 2,
                'comments_count' => 0,
                //'assignee' => json_encode([4]),
                'is_important' => false,
                'completed_on' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'name' => 'Ensuring UI consistency across different platforms and devices',
                'is_completed' => false,
                'task_list_id' => 4,
                'position' => 0,
                'start_on' => '2019-05-08 00:00:00',
                'due_on' => '2019-09-10 00:00:00',
                //'labels' => json_encode([1]),
                'open_subtasks' => 0,
                'comments_count' => 0,
                //'assignee' => json_encode([]),
                'is_important' => false,
                'completed_on' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'name' => 'Creating and implementing UI guidelines and best practices',
                'is_completed' => false,
                'task_list_id' => 4,
                'position' => 1,
                'start_on' => null,
                'due_on' => '2023-05-08 00:00:00',
                //'labels' => json_encode([]),
                'open_subtasks' => 0,
                'comments_count' => 0,
                //'assignee' => json_encode([]),
                'is_important' => true,
                'completed_on' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 14,
                'name' => 'Developing and integrating UI icons and images',
                'is_completed' => false,
                'task_list_id' => 4,
                'position' => 2,
                'start_on' => null,
                'due_on' => null,
                //'labels' => json_encode([]),
                'open_subtasks' => 0,
                'comments_count' => 0,
                //'assignee' => json_encode([]),
                'is_important' => false,
                'completed_on' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 15,
                'name' => 'Developing and integrating UI forms and validation',
                'is_completed' => false,
                'task_list_id' => 4,
                'position' => 4,
                'start_on' => '2023-05-08 00:00:00',
                'due_on' => '2023-09-10 00:00:00',
                //'labels' => json_encode([]),
                'open_subtasks' => 2,
                'comments_count' => 0,
                //'assignee' => json_encode([]),
                'is_important' => false,
                'completed_on' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 16,
                'name' => 'Creating and implementing UI tests',
                'is_completed' => false,
                'task_list_id' => 5,
                'position' => 0,
                'start_on' => '2023-05-08 00:00:00',
                'due_on' => '2023-09-10 00:00:00',
                //'labels' => json_encode([1, 2, 3, 4, 5, 6, 7, 8]),
                'open_subtasks' => 2,
                'comments_count' => 7,
                //'assignee' => json_encode([1]),
                'is_important' => false,
                'completed_on' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 17,
                'name' => 'Creating and implementing UI patterns for the page',
                'is_completed' => false,
                'task_list_id' => 5,
                'position' => 1,
                'start_on' => null,
                'due_on' => null,
                //'labels' => json_encode([]),
                'open_subtasks' => 0,
                'comments_count' => 0,
                //'assignee' => json_encode([]),
                'is_important' => false,
                'completed_on' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('labels')->insert([
            [
                'id' => 1,
                'color' => '#743C97',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'color' => '#F44336',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'color' => '#03A9F4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'color' => '#4CAF50',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'color' => '#FFC107',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'color' => '#9C27B0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'color' => '#3F51B5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'color' => '#9E9E9E',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'John Smith',
                'username' => 'johnsmith',
                'password' => Hash::make('password1'),
                'avatar_url' => 'https://i.pravatar.cc/150?u=1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Emma Watson',
                'username' => 'emmawatson',
                'password' => Hash::make('password2'),
                'avatar_url' => 'https://i.pravatar.cc/150?u=2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Michael Johnson',
                'username' => 'michaeljohnson',
                'password' => Hash::make('password3'),
                'avatar_url' => 'https://i.pravatar.cc/150?u=3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Emily Brown',
                'username' => 'emilybrown',
                'password' => Hash::make('password4'),
                'avatar_url' => 'https://i.pravatar.cc/150?u=4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        DB::table('label_task')->insert([
            [
                'task_id' => 5,
                'label_id' => 1,
            ],
            [
                'task_id' => 5,
                'label_id' => 2,
            ],
            [
                'task_id' => 5,
                'label_id' => 3,
            ],
            [
                'task_id' => 5,
                'label_id' => 4,
            ],
            [
                'task_id' => 5,
                'label_id' => 5,
            ],
            [
                'task_id' => 5,
                'label_id' => 6,
            ],
            [
                'task_id' => 5,
                'label_id' => 7,
            ],
            [
                'task_id' => 5,
                'label_id' => 8,
            ],
            [
                'task_id' => 6,
                'label_id' => 1,
            ],
            [
                'task_id' => 6,
                'label_id' => 2,
            ],
            [
                'task_id' => 6,
                'label_id' => 3,
            ],
            [
                'task_id' => 6,
                'label_id' => 4,
            ],
            [
                'task_id' => 6,
                'label_id' => 5,
            ],
            [
                'task_id' => 6,
                'label_id' => 6,
            ],
            [
                'task_id' => 6,
                'label_id' => 7,
            ],
            [
                'task_id' => 6,
                'label_id' => 8,
            ],
            [
                'task_id' => 8,
                'label_id' => 1,
            ],
            [
                'task_id' => 8,
                'label_id' => 2,
            ],
            [
                'task_id' => 8,
                'label_id' => 3,
            ],
            [
                'task_id' => 10,
                'label_id' => 1,
            ],
            [
                'task_id' => 10,
                'label_id' => 2,
            ],
            [
                'task_id' => 11,
                'label_id' => 4,
            ],
            [
                'task_id' => 12,
                'label_id' => 1,
            ],
            [
                'task_id' => 16,
                'label_id' => 1,
            ],
            [
                'task_id' => 16,
                'label_id' => 2,
            ],
            [
                'task_id' => 16,
                'label_id' => 3,
            ],
            [
                'task_id' => 16,
                'label_id' => 4,
            ],
            [
                'task_id' => 16,
                'label_id' => 5,
            ],
            [
                'task_id' => 16,
                'label_id' => 6,
            ],
            [
                'task_id' => 16,
                'label_id' => 7,
            ],
            [
                'task_id' => 16,
                'label_id' => 8,
            ],
        ]);

        DB::table('assignee_task')->insert([
            [
                'task_id' => 3,
                'assignee_id' => 1,
            ],
            [
                'task_id' => 5,
                'assignee_id' => 1,
            ],
            [
                'task_id' => 6,
                'assignee_id' => 1,
            ],
            [
                'task_id' => 9,
                'assignee_id' => 3,
            ],
            [
                'task_id' => 10,
                'assignee_id' => 3,
            ],
            [
                'task_id' => 10,
                'assignee_id' => 2,
            ],
            [
                'task_id' => 10,
                'assignee_id' => 1,
            ],
            [
                'task_id' => 11,
                'assignee_id' => 4,
            ],
            [
                'task_id' => 16,
                'assignee_id' => 1,
            ],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
