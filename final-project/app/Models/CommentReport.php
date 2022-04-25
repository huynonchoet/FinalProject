<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentReport extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "comment_reports";

    protected $fillable =
    [
        'id',
        'user_id',
        'comment_id',
        'content',
        'status'
    ];
}
