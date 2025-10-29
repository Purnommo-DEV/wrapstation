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
        Schema::create('inspection_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wrap_station_id')->constrained()->cascadeOnDelete();
            $table->string('category'); // Paint, Glass, Tires
            $table->string('item_name'); // Paint, Windshield, Tires
            $table->enum('condition', ['G', 'F', 'P']);
            $table->text('note')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_items');
    }
};
