<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('hsn')->nullable();
            $table->string('unit')->nullable();
            $table->decimal('sales_price', 15, 2)->nullable();
            $table->string('tax_type')->nullable();
            $table->string('gst')->nullable();
            $table->integer('cess')->nullable();
            $table->string('cess_type')->nullable();
            $table->decimal('purchase_price', 15, 2)->nullable();
            $table->string('price_type')->nullable();
            $table->string('item_type')->nullable();
            $table->decimal('wholesale_price', 15, 2)->nullable();
            $table->string('item_code')->nullable();
            $table->string('income_account_type');
            $table->string('account_group');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
