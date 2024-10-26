<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('account_type_id')->nullable();
            $table->foreign('account_type_id', 'account_type_fk_7083255')->references('id')->on('account_types');
            $table->unsignedBigInteger('account_name_id')->nullable();
            $table->foreign('account_name_id', 'account_name_fk_7083256')->references('id')->on('account_names');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7083257')->references('id')->on('teams');
        });
    }
}
