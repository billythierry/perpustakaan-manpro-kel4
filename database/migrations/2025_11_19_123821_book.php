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
        Schema::create('book', function (Blueprint $table) {
            $table->id('book_id'); // Sama dengan int not null primary key auto_increment
            $table->string('title', 255);
            $table->string('author', 255);
            $table->string('publisher', 255);
            
            // Tipe data YEAR
            $table->year('year'); 
            
            $table->integer('stock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book');
    }
};