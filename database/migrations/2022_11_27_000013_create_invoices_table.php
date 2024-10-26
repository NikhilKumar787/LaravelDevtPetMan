<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->date('invoice_date');
            $table->string('invoice_no');
            $table->string('customer_email')->nullable();
            $table->boolean('send_later')->default(0)->nullable();
            $table->date('due_date')->nullable();
            $table->string('type_of_supply')->nullable();
            $table->boolean('invoice_request')->default(0)->nullable();
            $table->longText('message_on_invoice')->nullable();
            $table->longText('message_on_statement')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('discount_amount')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
