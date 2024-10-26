<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsAndconditionsTable extends Migration
{
    public function up()
    {
        Schema::create('terms_andconditions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('body')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
