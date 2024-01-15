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
        Schema::create('price_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('room_id');
            $table->decimal('price_high', 8, 2);
            $table->decimal('price_low', 8, 2);
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_rooms');
    }
};
