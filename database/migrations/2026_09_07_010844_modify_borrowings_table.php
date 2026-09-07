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
        Schema::table('borrowings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->change();
            $table->unsignedBigInteger('book_id')->change();

            $table->dateTime('borrowed_at')->change();
            $table->date('due_date')->change();
            $table->dateTime('returned_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->string('user_id')->change();
            $table->string('book_id')->change();

            $table->string('borrowed_at')->change();
            $table->string('due_date')->change();
            
            // Ubah bagian ini agar mengizinkan NULL saat di-rollback
            $table->string('returned_at')->nullable()->change();
        });
    }
};