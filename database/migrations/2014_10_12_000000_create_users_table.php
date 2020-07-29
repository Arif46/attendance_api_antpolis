<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('personal_email')->unique();
            $table->string('mobile_number')->nullable();
            $table->string('gender')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('fb_username')->nullable();
            $table->string('emergency_person_name')->nullable();
            $table->string('emergency_person_relation')->nullable();
            $table->string('emergency_number')->nullable();
            $table->string('discord_id')->nullable();
            $table->string('blood_group')->nullable();
            $table->date('dob')->nullable();
            $table->string('photo')->nullable();
            $table->string('identification_number')->nullable();
            $table->string('identification_photo')->nullable();
            $table->string('identification_type')->nullable();
            $table->string('medical_condition')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default('$2y$12$H48o62uiywd1m.uo4MCS.O5hFWnGkUf/I8PwWzsYhF0baa0alp2Am');
            $table->boolean('is_approved')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
