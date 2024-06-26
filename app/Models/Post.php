<?php

namespace App\Models;

use Carbon\Carbon;
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
        return $this->belongsTo(User::class, 'userId');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'postId');
    }

    public function likes()
    {
        return $this->belongsToMany(Like::class);
    }

    public function scopeLatestPost()
    {
        return $this->orderBy('created_at', 'desc');
    }

    public function getCreatedAtAttribute()
    {
        $createdAt = Carbon::parse($this->attributes['created_at']);
        $now = Carbon::now();


        $diffInSeconds = $createdAt->diffInSeconds($now);
        $diffInMinutes = $createdAt->diffInMinutes($now);
        $diffInHours = $createdAt->diffInHours($now);
        $diffInDays = $createdAt->diffInDays($now);
        $diffInMonths = $createdAt->diffInMonths($now);
        $diffInYears = $createdAt->diffInYears($now);

        if ($diffInYears > 0) {
            return $diffInYears . 'y';
        } elseif ($diffInMonths > 0) {
            return $diffInMonths . ' month ago';
        } elseif ($diffInDays > 0) {
            return $diffInDays . ' day ago';
        } elseif ($diffInHours > 0) {
            return $diffInHours . 'h';
        } elseif ($diffInMinutes > 0) {
            return $diffInMinutes . 'm';
        } else {
            return 'just now';
        }
    }

    public function getUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->diffForHumans();
    }


}
