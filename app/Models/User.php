<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;

    const GENDER = [
        'Male',
        'Female'
    ];

    const IS_BLOCKED = [
        true,
        false
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'avatar',
        'gender',
        'dob',
        'is_blocked',
        'is_hide',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function likes(): BelongsToMany {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id')->withTimestamps();
    }
    public function hasLiked(Post $post) {
        return $this->likes()->where('post_id', $post->id)->exists();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function followings() {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'user_id')->withTimeStamps();
    }

    public function followers() {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'follower_id')->withTimeStamps();
    }
    public function follows(User $user) {
        return $this->followings()->where('user_id', $user->id)->exists();
    }

    public function posts() {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }
}
