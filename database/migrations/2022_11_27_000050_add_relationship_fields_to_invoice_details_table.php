<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInvoiceDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('invoice_details', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->foreign('invoice_id', 'invoice_fk_6436897')->references('id')->on('invoices');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_6436898')->references('id')->on('products');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7082736')->references('id')->on('teams');
        });
    }
}
