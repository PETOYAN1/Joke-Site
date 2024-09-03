<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = [
        'follower_id',
        'user_id',
        'post_id',
    ];
    public function users() {
        return $this->belongsTo(Follow::class, 'user_id', 'follower_id');
    }
    public function follows() {
        return $this->belongsTo(Follow::class, 'follower_id', 'user_id');
    }
}
