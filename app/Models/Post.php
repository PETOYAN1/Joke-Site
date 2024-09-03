<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category_id',
        'image',
        'published'
    ];
    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function categories() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function comments(): HasMany
    {
        return $this->HasMany(Comment::class, 'post_id', 'id');
    }
    public function likes(): BelongsToMany {
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id')->withTimestamps();
    }

    public function likesPost($userId) {
        return $this->likes()->where('user_id', $userId)->exists();
    }
}
