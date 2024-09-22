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
     * The relationships that should be eager loaded.
     *
     * @var array
     */
    protected $with = ['user:id,name,image','comments.user:id,name,image'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'content',
    ];

    // relationships
    public function comments()
    {
        // return $this->hasMany(Comment::class,localKey,foreignKey); // if you are not using the same name for the table and the model
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the users that have liked this idea.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likes()
    {
        return $this->belongsToMany(User::class, 'idea_like')->withTimestamps();
    }
}
