<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company_name');
            $table->string('gst_type');
            $table->string('gstin')->nullable();
            $table->longText('address')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('pancard')->nullable();
            $table->string('other')->nullable();
            $table->string('website')->nullable();
            $table->longText('notes')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('account_no')->nullable();
            $table->string('tax_reg_no')->nullable();
            $table->string('effective_date')->nullable();
            $table->boolean('apply_tds')->default(0)->nullable();
            $table->string('entity')->nullable();
            $table->string('section')->nullable();
            $table->boolean('calculation_threshold')->default(0)->nullable();
            $table->boolean('is_my_customer')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
