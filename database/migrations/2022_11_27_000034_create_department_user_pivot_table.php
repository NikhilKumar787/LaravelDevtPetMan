<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('department_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_6437721')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id', 'department_id_fk_6437721')->references('id')->on('departments')->onDelete('cascade');
        });
    }
}
