<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadSubIndustriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_sub_industries', function (Blueprint $table) {
             $table->increments('id');
            $table->string('lead_sub_industry_name');
             $table->unsignedInteger('lead_industry_id');
            $table->foreign('lead_industry_id')->references('id')->on('lead_industries')->onDelete('cascade');
            // $table->integer('lead_industry_id');
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
        Schema::dropIfExists('lead_sub_industries');
    }
}
