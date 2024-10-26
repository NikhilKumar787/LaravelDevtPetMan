<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAccountNamesTable extends Migration
{
    public function up()
    {
        Schema::table('account_names', function (Blueprint $table) {
            $table->unsignedBigInteger('account_type_id')->nullable();
            $table->foreign('account_type_id', 'account_type_fk_7083217')->references('id')->on('account_types');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7083221')->references('id')->on('teams');
        });
    }
}
