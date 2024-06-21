<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    /**
     * The attributes that should be guarded against mass assignment.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'likes',
    ];

    // relationships
    public function comments()
    {
        // return $this->hasMany(Comment::class,localKey,foreignKey); // if you are not using the same name for the table and the model
        return $this->hasMany(Comment::class);
    }
}
