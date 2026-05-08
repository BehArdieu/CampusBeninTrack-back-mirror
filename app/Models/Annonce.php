<?php

namespace App\Models;

use App\Enums\AnnonceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Annonce extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'diaspora_id',
        'ville_id',
        'titre',
        'description',
        'photo',
        'universite',
        'status',
    ];

    protected $casts = [
        'status' => AnnonceStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function diaspora(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diaspora_id');
    }

    public function ville(): BelongsTo
    {
        return $this->belongsTo(Ville::class);
    }

    public function positionnements(): HasMany
    {
        return $this->hasMany(Positionnement::class);
    }

    public function reponses(): HasMany
    {
        return $this->hasMany(Reponse::class);
    }
}
