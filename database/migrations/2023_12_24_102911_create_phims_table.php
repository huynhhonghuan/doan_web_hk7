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
        Schema::create('phim', function (Blueprint $table) {
            $table->id();
            $table->string('ten',100);
            $table->longText('mota');
            $table->integer('khoa')->default(1);
            $table->string('slug');
            $table->string('hinhanh',255);
            $table->integer('phimhot');
            $table->integer('chatluong');
            $table->integer('phude');
            $table->string('nam',20)->default(2000);
            $table->string('thoiluong',50);
            $table->string('tags',100)->nullable();
            $table->integer('view');
            $table->string('trailer',255);
            $table->integer('sotap')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phim');
    }
};
