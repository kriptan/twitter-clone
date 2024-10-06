<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'bio',
        'is_admin',
    ];

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function ideas()
    {
        return $this->hasMany(Idea::class)->latest();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    // People who we follow
    // follower_id = our id
    // user_id = followed users id
    public function followings()
    {
        // belongsToMany(related, table, foreignPivotKey, relatedPivotKey, parentKey, relatedKey, relation)
        return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id')->withTimestamps();
    }

    // People who follow us
    public function followers()
    {
       // beloongsToMany(related, table, foreignPivotKey, relatedPivotKey, parentKey, relatedKey, relation)
        return $this->belongsToMany(User::class, 'follower_user', 'user_id', 'follower_id')->withTimestamps();
    }

    /**
     * Checks if the current user is following the given user.
     *
     * @param \App\Models\User $user The user to check if the current user is following.
     * @return bool True if the current user is following the given user, false otherwise.
     */
    public function follows(User $user)
    {
        return $this->followings()->where('user_id', $user->id)->exists();
    }

    /**
     * Returns a collection of ideas that the user has liked.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likes()
    {
        return $this->belongsToMany(Idea::class, 'idea_like')->withTimestamps();
    }


    public function likesIdea(Idea $idea)
    {
        return $this->likes()->where('idea_id', $idea->id)->exists();
    }


    public function getImageUrl()
    {
        
        // php artisan storage:link
        if ($this->image) {
            return url('/storage/'. $this->image);
        } else {
            return 'https://api.dicebear.com/6.x/fun-emoji/svg?seed='. $this->name . '';
        }
    }
}
