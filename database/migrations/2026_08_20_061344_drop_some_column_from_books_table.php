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
        Schema::table('books', function (Blueprint $table) {
            if (Schema::hasColumn('books', 'genre')) {
                $table->dropColumn('genre');
            }
            if (Schema::hasColumn('books', 'category')) {
                $table->dropColumn('category');
            }
            if (Schema::hasColumn('books', 'author')) {
                $table->dropColumn('author');
            }
            if (Schema::hasColumn('books', 'publisher')) {
                $table->dropColumn('publisher');
            }
            if (Schema::hasColumn('books', 'type')) {
                $table->dropColumn('type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'type')) {
                $table->string('type')->after('name');
            }
            if (!Schema::hasColumn('books', 'genre')) {
                $table->string('genre')->after('type');
            }
            if (!Schema::hasColumn('books', 'category')) {
                $table->dropColumn('category')->after('genre');
            }
            if (!Schema::hasColumn('books', 'author')) {
                $table->dropColumn('author')->after('cover_image');
            }
            if (!Schema::hasColumn('books', 'publisher')) {
                $table->dropColumn('publisher')->after('author');
            }
        });
    }
};
