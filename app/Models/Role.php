<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $primaryKey = 'role_id';

    protected $fillable = ['role_name', 'account_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'account_id', 'account_id');
    }
}
