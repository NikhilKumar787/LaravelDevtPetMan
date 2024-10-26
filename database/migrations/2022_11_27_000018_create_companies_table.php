<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username_for_pan_tan')->nullable();
            $table->string('password_for_pan_tan')->nullable();
            $table->string('username_for_gst_vat_icegate_dgft')->nullable();
            $table->string('password_for_gst_vat_icegate_dgft')->nullable();
            $table->string('username_for_e_way_e_invoicing')->nullable();
            $table->string('password_for_e_way_e_invoicing')->nullable();
            $table->string('username_for_traces')->nullable();
            $table->string('password_for_traces')->nullable();
            $table->string('username_for_pf_esi_and_other_labour_law')->nullable();
            $table->string('password_for_pf_esi_and_other_labour_law')->nullable();
            $table->string('username_for_reporting_portal')->nullable();
            $table->string('password_for_reporting_portal')->nullable();
            $table->string('company_name');
            $table->string('gstin')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
