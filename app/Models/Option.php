<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use HasFactory, SoftDeletes;
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'title',
        'description',
        'poll_uuid',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($option) {
            foreach ($option->votes()->get() as $vote) {
                $vote->delete();
            }
        });
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class, 'poll_uuid', 'uuid');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'option_uuid', 'uuid');
    }
}
