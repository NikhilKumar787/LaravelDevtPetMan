<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSubTasksTable extends Migration
{
    public function up()
    {
        Schema::table('sub_tasks', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id', 'department_fk_7681880')->references('id')->on('departments');
            $table->unsignedBigInteger('task_id')->nullable();
            $table->foreign('task_id', 'task_fk_7681887')->references('id')->on('tasks');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7681891')->references('id')->on('teams');
        });
    }
}
