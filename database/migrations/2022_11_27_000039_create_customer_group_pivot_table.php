<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerGroupPivotTable extends Migration
{
    public function up()
    {
        Schema::create('customer_group', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id', 'group_id_fk_7066307')->references('id')->on('groups')->onDelete('cascade');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id', 'customer_id_fk_7066307')->references('id')->on('customers')->onDelete('cascade');
        });
    }
}
