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
        Schema::create('truyen', function (Blueprint $table) {
            $table->id();
            $table->string('tentruyen');
            $table->string('slug');
            $table->string('nhomdich')->default('Không biết')->nullable();
            $table->longText('mota')->nullable();
            $table->string('hinhanh',255)->default('anhmacdinh.jpg');
            $table->integer('luotxem')->default(0);
            $table->integer('khoa')->default(0);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('truyen');
    }
};
