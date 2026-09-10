<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author_id',
        'category_id', // Tambahkan jika ada kolom ini di tabel books
        'cover_image',
        'year',
        'stock',
        'description',
    ];

    /**
     * Relasi ke Author
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Relasi Singular Category (Sesuai panggilan di BookController)
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Relasi Many-to-Many Categories
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Relasi Many-to-Many Publishers
     */
    public function publishers()
    {
        return $this->belongsToMany(Publisher::class);
    }

    /**
     * Relasi Many-to-Many Genres
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * Relasi Many-to-Many BookTypes
     */
    public function bookTypes()
    {
        return $this->belongsToMany(BookType::class);
    }
}