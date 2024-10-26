<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('qty');
            $table->decimal('rate', 15, 2);
            $table->decimal('amount', 15, 2);
            $table->string('tax');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
