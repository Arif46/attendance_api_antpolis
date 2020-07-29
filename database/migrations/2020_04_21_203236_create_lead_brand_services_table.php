<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadBrandServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_brand_services', function (Blueprint $table) {
            $table->increments('id');
             $table->unsignedInteger('lead_brand_id');
            $table->foreign('lead_brand_id')->references('id')->on('lead_brands')->onDelete('cascade');
            
             $table->unsignedInteger('lead_product_or_service_id');
            $table->foreign('lead_product_or_service_id')->references('id')->on('lead_product_or_services')->onDelete('cascade');
            // $table->integer('lead_brand_id');
            // $table->integer('lead_product_or_service_id');
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
        Schema::dropIfExists('lead_brand_services');
    }
}
