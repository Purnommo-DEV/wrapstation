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
        Schema::create('wrap_stations', function (Blueprint $table) {
            $table->id();
            $table->string('customer_front_name');
            $table->string('customer_last_name');
            $table->string('customer_phone');
            $table->string('car_brand');
            $table->string('car_model');
            $table->string('color');
            $table->integer('year');
            $table->string('license_plate');
            $table->date('inspection_date');
            $table->string('signature_path')->nullable();
            $table->boolean('terms_agreed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wrap_stations');
    }
};
