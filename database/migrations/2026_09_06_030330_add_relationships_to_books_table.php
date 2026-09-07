<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {

            $table->foreignId('author_id')
                ->constrained('authors')
                ->onDelete('cascade');

            $table->foreignId('genre_id')
                ->constrained('genres')
                ->onDelete('cascade');

            $table->foreignId('category_id')
                ->constrained('categories')
                ->onDelete('cascade');

            $table->foreignId('book_type_id')
                ->constrained('book_types')
                ->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {

            $table->dropForeign(['author_id']);
            $table->dropForeign(['genre_id']);
            $table->dropForeign(['category_id']);
            $table->dropForeign(['book_type_id']);

            $table->dropColumn([
                'author_id',
                'genre_id',
                'category_id',
                'book_type_id',
            ]);

        });
    }
};