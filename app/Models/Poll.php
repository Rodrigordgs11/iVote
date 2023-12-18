<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poll extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'description',
        'poll_privacy',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'owner_uuid'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($poll) {
            
            foreach ($poll->votes()->get() as $vote) {
                $vote->delete();
            }

            foreach ($poll->options()->get() as $option) {
                $option->delete();
            }

            foreach ($poll->attachments()->get() as $attachment) {
                $attachment->delete();
            }

            $poll->users()->detach();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_uuid', 'uuid');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'shared_polls');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'poll_uuid', 'uuid');
    }

    public function options()
    {
        return $this->hasMany(Option::class, 'poll_uuid', 'uuid');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'poll_uuid', 'uuid');
    }
}
