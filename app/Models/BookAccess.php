<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAccess extends Model
{
    use HasFactory;
    protected $primaryKey = 'book_access_id';

    protected $fillable = ['account_id', 'book_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'account_id', 'account_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }   
}
