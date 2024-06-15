<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'profilepicture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'email',
        'created_at',
        'updated_at',

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //** Relations **/

    public function posts()
    {
        return $this->hasMany(Post::class,'userId');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class,'userId');
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function followers()
    {
        return $this->hasMany(Follow::class,'followerId');
    }
    public function following()
    {
        return $this->hasMany(Follow::class,'followeeId');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class,'userId');
    }

    //** Mutators **/
    public function setEmailAttribute(string $email)
    {
        $this->attributes['email'] = strtolower($email);
    }
    public function getEmailAttribute()
    {
        return $this->attributes['email'];
    }

}
