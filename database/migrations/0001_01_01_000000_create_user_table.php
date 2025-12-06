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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id'); // Sama dengan int not null primary key auto_increment
            $table->string('username', 100)->unique();
            $table->string('email', 255);
            $table->string('address', 255);
            $table->string('password_hash', 255);
            
            // Menggantikan ENUM('admin', 'anggota')
            $table->enum('role', ['admin', 'anggota'])->default('anggota');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};