<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $fillable = [
        'followerId',
        'followeeId',
    ];
    public function follower()
    {
        return $this->belongsTo(User::class, 'followeeId');
    }

    public function followee()
    {
        return $this->belongsTo(User::class, 'followeeId');
    }
}
