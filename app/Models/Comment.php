<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'userId',
        'postId',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'userId');
    }
    public function post()
    {
        return $this->belongsTo(Post::class,'postId');
    }

    public function scopeLatest()
    {
        return $this->orderBy('created_at', 'desc');
    }
}
