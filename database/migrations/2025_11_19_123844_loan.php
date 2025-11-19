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
        Schema::create('loan', function (Blueprint $table) {
            $table->id('loan_id'); // Sama dengan int not null primary key auto_increment

            // Foreign Key member_id
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')
                  ->references('member_id')
                  ->on('member')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            // Foreign Key book_id
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')
                  ->references('book_id')
                  ->on('book')
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
        Schema::dropIfExists('loan');
    }
};