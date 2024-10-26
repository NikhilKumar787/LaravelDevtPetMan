<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubTaskTaskTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('sub_task_task_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('sub_task_id');
            $table->foreign('sub_task_id', 'sub_task_id_fk_7681883')->references('id')->on('sub_tasks')->onDelete('cascade');
            $table->unsignedBigInteger('task_tag_id');
            $table->foreign('task_tag_id', 'task_tag_id_fk_7681883')->references('id')->on('task_tags')->onDelete('cascade');
        });
    }
}
