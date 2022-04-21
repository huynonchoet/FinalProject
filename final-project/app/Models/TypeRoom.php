<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeRoom extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "type_rooms";

    protected $fillable = ['name', 'status'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    public function getStatusLabelAttribute()
    {
        return [
            '0' => 'Pending',
            '1' => 'Accepted'
        ][$this->status];
    }
}
