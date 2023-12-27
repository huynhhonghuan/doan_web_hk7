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
        Schema::table('phim', function (Blueprint $table) {
            $table->foreignId('danhmuc_id')->constrained('danhmuc')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('quocgia_id')->constrained('quocgia')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phim', function (Blueprint $table) {
            $table->dropForeign('phim_theloai_id_foreign');
            $table->dropForeign('phim_danhmuc_id_foreign');
            $table->dropForeign('phim_quocgia_id_foreign');
            $table->dropForeign('phim_user_id_foreign');
        });
    }
};
