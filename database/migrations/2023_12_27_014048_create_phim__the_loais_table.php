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
        Schema::create('phim_theloai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('phim_id')->constrained('phim')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('theloai_id')->constrained('theloai')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phim_theloai');
    }
};
