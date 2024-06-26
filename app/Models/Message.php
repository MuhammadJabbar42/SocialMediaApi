<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'senderId',
        'reciverId',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'senderId');
    }

    public function reciver()
    {
        return $this->belongsTo(User::class, 'reciverId');
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
