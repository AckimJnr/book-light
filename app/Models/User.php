<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
	protected $primaryKey = 'user_id';
    protected $foreignKey = 'account_id';
	public $incrementing = false;
	public $timestamps = true;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'user_id' => 'int',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $fillable = ['user_id', 'full_name', 'email', 'password'];

    public function role()
    {
        return $this->hasOne(Role::class, 'account_id', 'account_id');
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'author_account_id', 'account_id');
    }

    public function bookAccesses()
    {
        return $this->hasMany(BookAccess::class, 'account_id', 'account_id');
    }
}