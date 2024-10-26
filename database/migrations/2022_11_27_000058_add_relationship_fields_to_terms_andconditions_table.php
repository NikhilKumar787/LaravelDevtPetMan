<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTermsAndconditionsTable extends Migration
{
    public function up()
    {
        Schema::table('terms_andconditions', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7191907')->references('id')->on('teams');
        });
    }
}
