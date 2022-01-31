<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Show extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * The characters that belong to the show.
     */
    public function characters(): BelongsToMany
    {
        return $this->belongsToMany(Character::class,'show_characters', 'character_id', 'show_id');
    }
}
