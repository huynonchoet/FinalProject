<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Homestay extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'images',
        'address',
        'phone',
        'user_id',
    ];

    /** 
     * Get the room that owns the homestay.
     */
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    /**
     * Get the comment that owns the homestay.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the rate that owns the homestay.
     */
    public function rates()
    {
        return $this->hasMany(Rate::class);
    }
}
