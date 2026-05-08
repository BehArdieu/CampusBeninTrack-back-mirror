<?php

namespace App\Models;

use App\Enums\PositionnementStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Positionnement extends Model
{
    use HasFactory;

    protected $fillable = [
        'annonce_id',
        'diaspora_id',
        'message',
        'status',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => PositionnementStatus::class,
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
}
