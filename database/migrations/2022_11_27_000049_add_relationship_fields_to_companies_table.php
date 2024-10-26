<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCompaniesTable extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_6437090')->references('id')->on('cities');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id', 'state_fk_6437091')->references('id')->on('states');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7082732')->references('id')->on('teams');
        });
    }
}
