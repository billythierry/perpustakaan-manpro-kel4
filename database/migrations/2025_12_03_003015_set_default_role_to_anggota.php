<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Pastikan tidak ada NULL sebelum mengubah jadi NOT NULL
        DB::statement("UPDATE `user` SET `role` = 'anggota' WHERE `role` IS NULL");

        // MySQL: tambahkan DEFAULT 'anggota' tanpa menghapus data
        DB::statement("ALTER TABLE `user` MODIFY `role` ENUM('admin','anggota') NOT NULL DEFAULT 'anggota'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE `user` MODIFY `role` ENUM('admin','anggota') NOT NULL");
    }
};