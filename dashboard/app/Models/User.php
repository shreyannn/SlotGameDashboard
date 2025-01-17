<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Method to check if the user is an admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Method to check if the user is a player
    public function isPlayer()
    {
        return $this->role === 'player';
    }

    public function ban()
    {
        $this->banned = true;  // Set the 'banned' field to true
        $this->save();  // Save the changes to the database
    }

    /**
     * Unban the user.
     *
     * @return void
     */
    public function unban()
    {
        $this->banned = false;  // Set the 'banned' field to false
        $this->save();  // Save the changes to the database
    }

    public function isBanned()
    {
        return $this->banned;
    }
}
