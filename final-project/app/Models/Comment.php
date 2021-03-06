<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'homestay_id',
        'status',
        'parent_id',
        'content',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the user that author of the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the report of the comment.
     */
    public function report()
    {
        return $this->hasMany(CommentReport::class);
    }
}
