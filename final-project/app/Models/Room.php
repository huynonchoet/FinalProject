<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'images',
        'price',
        'description',
        'discount',
        'quantity_room',
        'status',
        'homestay_id',
        'type_room_id',
        'created_at',
    ];

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post that owns the comment.
     */
    public function typeRoom()
    {
        return $this->belongsTo(TypeRoom::class);
    }
}
