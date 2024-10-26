<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAssignedTasksTable extends Migration
{
    public function up()
    {
        Schema::table('assigned_tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('task_id')->nullable();
            $table->foreign('task_id', 'task_fk_6442440')->references('id')->on('tasks');
            $table->unsignedBigInteger('assigned_to_id')->nullable();
            $table->foreign('assigned_to_id', 'assigned_to_fk_6442441')->references('id')->on('users');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id', 'company_fk_6442442')->references('id')->on('companies');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_6442443')->references('id')->on('users');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_6442448')->references('id')->on('task_statuses');
        });
    }
}
