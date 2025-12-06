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
        Schema::create('loans', function (Blueprint $table) {
            $table->id('loan_id'); // Sama dengan int not null primary key auto_increment

            // Foreign Key user_id
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            // Foreign Key book_id
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')
                  ->references('book_id')
                  ->on('books')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->date('borrow_date');
            $table->date('due_date');
            $table->date('return_date')->nullable(); // Kolom ini bisa NULL
            
            // Menggantikan ENUM
            $table->enum('status', ['diajukan', 'ditolak', 'dipinjam', 'dikembalikan']);
            
            // Kolom DECIMAL dengan default 0
            $table->decimal('fine_amount', 8, 2)->default(0); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};