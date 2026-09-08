<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Category;
use App\Models\BookType;
use App\Models\Publisher;

class Book extends Model
{
    protected $fillable = [
        'name',
        'author_id',
        'cover_image',
        'year',
        'stock',
        'description',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publishers()
    {
        return $this->belongsToMany(Publisher::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function bookTypes()
    {
        return $this->belongsToMany(BookType::class);
    }
}