<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids, SoftDeletes;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'phone_number',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->sharedPolls()->detach();

            foreach ($user->polls()->get() as $poll) {
                $poll->delete();
              }
            
            foreach ($user->votes()->get() as $vote) {
                $vote->delete();
            }

            foreach ($user->notifications()->get() as $notification) {
                $notification->delete();
            }
        });
    }

    public function polls()
    {
        return $this->hasMany(Poll::class, 'owner_uuid', 'uuid');
    }

    public function sharedPolls(): BelongsToMany
    {
        return $this->belongsToMany(Poll::class, 'shared_polls');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'user_uuid', 'uuid');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_uuid', 'uuid');
    }
}
