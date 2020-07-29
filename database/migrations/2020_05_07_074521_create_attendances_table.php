<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('user_id');
            $table->timestamp('attendance_date',6);
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->char('status')->nullable();
            $table->boolean('is_approved_a')->default(0);
            $table->boolean('is_approved_s')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
