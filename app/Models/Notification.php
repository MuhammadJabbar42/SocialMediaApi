<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Notification extends Model
{
    use HasFactory,Notifiable;
    
    protected $fillable = [
        'userId',
        'type',
        'read_at',
        'data',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'userId');
    }
    
}
