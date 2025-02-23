<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    public $incrementing = false;

    /**
     * The "primary key" for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The "key type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'bio',
        'profile_photo',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Boot the model to handle UUID generation.
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->id)) {
                $user->id = (string) Str::uuid();
            }
        });
    }

    /**
     * Accessor for the profile photo URL.
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo ? Storage::url($this->profile_photo) : '/default-profile.png';
    }

    /**
     * Get the senders (friends who sent requests to this user).
     */
    public function senders()
    {
        return $this->hasMany(FriendRequest::class, 'sender_id');
    }

    /**
     * Get the receivers (friends who received requests from this user).
     */
    public function receivers()
    {
        return $this->hasMany(FriendRequest::class, 'receiver_id');
    }

    /**
     * Generate a unique username based on first name and a random integer if needed.
     *
     * @param string $firstName
     * @return string
     */
    public static function generateUsername(string $firstName): string
    {
        $baseUsername = strtolower($firstName) . rand(1000, 9999);

        // Ensure the username is unique
        while (self::where('username', $baseUsername)->exists()) {
            $baseUsername = strtolower($firstName) . rand(1000, 9999);
        }

        return $baseUsername;
    }
}
