<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Category;
use App\Models\BookType;

class Book extends Model
{
    protected $fillable = [
        'name',
        'author_id',
        'genre_id',
        'category_id',
        'book_type_id',
        'cover_image',
        'year',
        'stock',
        'description',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bookType()
    {
        return $this->belongsTo(BookType::class);
    }
}