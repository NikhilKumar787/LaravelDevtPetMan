<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAssignedTaskDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('assigned_task_details', function (Blueprint $table) {
            $table->unsignedBigInteger('task_id')->nullable();
            $table->foreign('task_id', 'task_fk_6442490')->references('id')->on('tasks');
            $table->unsignedBigInteger('assigned_task_id')->nullable();
            $table->foreign('assigned_task_id', 'assigned_task_fk_6442491')->references('id')->on('assigned_tasks');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_6442495')->references('id')->on('task_statuses');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7679770')->references('id')->on('users');
        });
    }
}
