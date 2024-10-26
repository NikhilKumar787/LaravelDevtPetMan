<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignedSubTasksTable extends Migration
{
    public function up()
    {
        Schema::create('assigned_sub_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('description')->nullable();
            $table->integer('hours_estimation')->nullable();
            $table->boolean('is_approved')->default(0)->nullable();
            $table->date('target_date')->nullable();
            $table->date('completed_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
