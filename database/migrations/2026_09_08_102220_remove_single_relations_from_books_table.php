<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['genre_id']);
            $table->dropForeign(['category_id']);
            $table->dropForeign(['book_type_id']);

            $table->dropColumn([
                'publisher_id',
                'genre_id',
                'category_id',
                'book_type_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->foreignId('publisher_id')
                ->nullable()
                ->constrained('publishers')
                ->nullOnDelete();

            $table->foreignId('genre_id')
                ->nullable()
                ->constrained('genres')
                ->nullOnDelete();

            $table->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->nullOnDelete();

            $table->foreignId('book_type_id')
                ->nullable()
                ->constrained('book_types')
                ->nullOnDelete();
        });
    }
};