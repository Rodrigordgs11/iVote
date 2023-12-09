<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Poll extends Model
{
    use HasFactory;
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

    public function user()
    {
        return $this->belongsTo(User::class, 'owner_uuid', 'uuid');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'shared_polls');
    }
}
