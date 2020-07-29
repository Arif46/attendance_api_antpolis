<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadProductOrServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_product_or_services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lead_product_or_service_name');
            $table->tinyInteger('is_lead_product_or_service');
             $table->unsignedInteger('lead_sub_industry_id');
            $table->foreign('lead_sub_industry_id')->references('id')->on('lead_sub_industries')->onDelete('cascade');
            // $table->integer('lead_sub_industry_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_product_or_services');
    }
}
