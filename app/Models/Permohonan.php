<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Permohonan extends Model implements HasMedia
{
    use HasUuids;
    use InteractsWithMedia;

    protected $fillable = [
        'layanan_id',
        'prasyarat',
        'formulir',
        'is_active'
    ];

    protected $casts = [
        'prasyarat' => 'array',
        'formulir' => 'array',
    ];

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'id');
    }

    public function status(): MorphMany
    {
        return $this->morphMany(PermohonanStatus::class, 'permohonan', 'permohonan_type', 'permohonan_id');
    }
}
