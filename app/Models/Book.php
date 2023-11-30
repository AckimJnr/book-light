<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $primaryKey = 'book_id';

    protected $fillable = ['title', 'total_pages', 'rating', 'isbn', 'publisher', 'published_date', 'book_url', 'author_account_id'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_account_id', 'account_id');
    }

    public function bookAccess()
    {
        return $this->hasMany(BookAccess::class, 'book_id', 'book_id');
    }
}
