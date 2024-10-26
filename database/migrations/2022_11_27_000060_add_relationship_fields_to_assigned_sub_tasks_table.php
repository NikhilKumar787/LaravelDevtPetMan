<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAssignedSubTasksTable extends Migration
{
    public function up()
    {
        Schema::table('assigned_sub_tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('task_id')->nullable();
            $table->foreign('task_id', 'task_fk_7681893')->references('id')->on('tasks');
            $table->unsignedBigInteger('sub_task_id')->nullable();
            $table->foreign('sub_task_id', 'sub_task_fk_7681933')->references('id')->on('sub_tasks');
            $table->unsignedBigInteger('assigned_to_id')->nullable();
            $table->foreign('assigned_to_id', 'assigned_to_fk_7681894')->references('id')->on('users');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id', 'company_fk_7681895')->references('id')->on('companies');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7681896')->references('id')->on('users');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_7681901')->references('id')->on('task_statuses');
            $table->unsignedBigInteger('assigned_task_id')->nullable();
            $table->foreign('assigned_task_id', 'assigned_task_fk_7681909')->references('id')->on('assigned_tasks');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7681908')->references('id')->on('teams');
        });
    }
}
