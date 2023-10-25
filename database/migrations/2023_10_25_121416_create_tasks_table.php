<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_completed');
            $table->unsignedBigInteger('task_list_id');
            $table->foreign('task_list_id')->references('id')->on('task_lists')->
                onDelete('cascade');
            $table->integer('position');
            $table->dateTime('start_on')->nullable();
            $table->dateTime('due_on')->nullable();
            //$table->json('labels');
            $table->integer('open_subtasks');
            $table->integer('comments_count');
            //$table->json('assignee');
            $table->boolean('is_important');
            $table->dateTime('completed_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
