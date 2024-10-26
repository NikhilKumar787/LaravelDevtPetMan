<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gstin')->nullable();
            $table->string('gst_type')->nullable();
            $table->string('gst_customer_name')->nullable();
            $table->string('mobile')->nullable();
            $table->longText('address')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('company');
            $table->string('other')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->longText('notes')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('tan')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('delivery_method')->nullable();
            $table->string('optional_data_1')->nullable();
            $table->string('optional_data_2')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_my_vendor')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
