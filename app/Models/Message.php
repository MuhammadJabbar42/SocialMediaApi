<?php

namespace App\Models;

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
}
