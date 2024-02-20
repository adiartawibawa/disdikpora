<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Layanan extends Model implements HasMedia
{
    use HasUuids;
    use Sluggable;
    use InteractsWithMedia;

    protected $fillable = [
        'nama',
        'slug',
        'estimasi',
        'desc',
        'panduan',
        'prasyarat',
        'formulir',
        'is_active'
    ];

    protected $casts = [
        'panduan' => 'array',
        'prasyarat' => 'array',
        'formulir' => 'array',
    ];

    protected $appends = ['ilustrasi_url'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }

    public function ketentuans(): MorphMany
    {
        return $this->morphMany(Ketentuan::class, 'ketentuan', 'ketentuan_type', 'ketentuan_id');
    }

    public function getIlustrasiUrlAttribute()
    {
        return $this->getFirstMediaUrl('ilustrasi-layanan');
    }
}
