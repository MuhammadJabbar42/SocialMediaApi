<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'content',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'userId');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'postId');
    }

    public function likes()
    {
        return $this->belongsToMany(Like::class);
    }

    public function scopeLatestPost()
    {
        return $this->orderBy('created_at', 'desc');
    }
    
}
