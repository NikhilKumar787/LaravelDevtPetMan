<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsTable extends Migration
{
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('credit_period');
            $table->string('credit_period_days');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
