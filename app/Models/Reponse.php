<?php

namespace App\Models;

use App\Enums\ReponseStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'annonce_id',
        'diaspora_id',
        'address',
        'prix',
        'status',
        'images',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => ReponseStatus::class,
            'read_at' => 'datetime',
        ];
    }

    public function annonce(): BelongsTo
    {
        return $this->belongsTo(Annonce::class);
    }

    public function diaspora(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diaspora_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
