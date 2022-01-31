<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Character extends Model
{
    use HasFactory;

    protected $guarded = [];


    /**
     * The shows the character participated in.
     */
    public function shows(): BelongsToMany
    {
        return $this->belongsToMany(Show::class, 'show_characters', 'show_id', 'character_id');
    }


    /**
     * The character has many quotes
     */
    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class);
    }

}
