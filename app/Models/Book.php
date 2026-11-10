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
        'cover_image',
        'year',
        'stock',
        'description',
    ];

    // Relasi ke Author
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    // Relasi Many-to-Many Categories
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    // Relasi Many-to-Many Publishers
    public function publishers()
    {
        return $this->belongsToMany(Publisher::class);
    }

    // Relasi Many-to-Many Genres
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    // Relasi Many-to-Many Book Types
    public function bookTypes()
    {
        return $this->belongsToMany(BookType::class);
    }
}
