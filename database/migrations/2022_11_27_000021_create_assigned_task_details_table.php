<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignedTaskDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('assigned_task_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->boolean('is_approved')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
