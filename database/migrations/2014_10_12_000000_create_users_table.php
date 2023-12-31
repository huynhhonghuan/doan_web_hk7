<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username', 100);
            $table->string('sdt', 10)->unique()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status')->default('active');
            $table->string('facebook_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

        $pass = Hash::make('12345678');
        $date = date("Y-m-d H:i:s");

        DB::table('users')->insert([
            ['name' => 'Huỳnh Hồng Huân', 'username' => 'hhhuan_21th', 'sdt' => '0374692834', 'email' => 'hhhuan_21th@student.agu.edu.vn', 'password' => $pass],
            ['name' => 'Nguyễn Thị Tường Dân', 'username' => 'nttdan_21th', 'sdt' => '0332543351', 'email' => 'nttdan_21th@student.agu.edu.vn', 'password' => $pass],
            ['name' => 'Ngưyễn Tuấn Anh', 'username' => 'ntanh_21th', 'sdt' => '0123456799', 'email' => 'ntanh_21th@student.agu.edu.vn', 'password' => $pass],
            ['name' => 'Dương Khải Duy', 'username' => 'dkduy_21th', 'sdt' => '0123456749', 'email' => 'dkduy_21th@student.agu.edu.vn', 'password' => $pass],
            ['name' => 'Người dùng', 'username' => 'nguoidung', 'sdt' => '0123456559', 'email' => 'nguoidung@gmail.com', 'password' => $pass],
            ['name' => 'Cộng tác viên truyện', 'username' => 'congtacvientruyen', 'sdt' => '0123456789', 'email' => 'congtacvientruyen@gmail.com', 'password' => $pass],
            ['name' => 'Cộng tác viên phim', 'username' => 'congtacvienphim', 'sdt' => '0123456788', 'email' => 'congtacvienphim@gmail.com', 'password' => $pass],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
