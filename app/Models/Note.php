<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    public $fillable = [
        'user_id',
        'title',
        'text'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
