<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quote extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * The quote belongs to a character
     */
    public function character(): BelongsTo
    {
        return $this->belongsTo(Character::class);
    }

}
