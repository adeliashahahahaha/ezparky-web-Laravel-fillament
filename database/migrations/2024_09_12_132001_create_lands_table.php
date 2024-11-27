<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nik');
            $table->string('address');
            $table->string('phone');
            $table->date('dob');
            $table->integer('size');
            $table->enum('type', ['private', 'public']);
            $table->enum('land_status', ['property_right', 'monthly_rent', 'yearly_rent']);
            $table->string('photo')->nullable();
            $table->enum('status', ['waiting', 'accepted', 'rejected'])->default('waiting');
            $table->integer('car_capacity')->default(0);
            $table->integer('motor_capacity')->default(0);
            $table->integer('bicycle_capacity')->default(0);
            // $table->json('location')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lands');
    }
};
