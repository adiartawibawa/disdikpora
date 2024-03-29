<?php

namespace App\Models;

use App\Concerns\Multitenantable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Sekolah extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasUuids;
    use SoftDeletes;
    use Sluggable;
    use Multitenantable;

    protected $fillable = [
        'npsn',
        'nama',
        'organisation_id',
        'sekolah_bentuks_code',
        'status',
        'alamat',
        'desa_code',
        'meta'
    ];

    protected $searchableColumns = ['npsn', 'nama', 'status', 'desa.name', 'bentuk.name'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_code', 'code');
    }

    public function bentuk()
    {
        return $this->belongsTo(SekolahBentuk::class, 'sekolah_bentuks_code', 'code');
    }

    public function pegawais()
    {
        return $this->hasMany(GuruTendik::class, 'organisation_id', 'organisation_id');
    }

    public function tanahs()
    {
        return $this->hasMany(SarprasTanah::class, 'organisation_id', 'organisation_id');
    }

    public function ruangs()
    {
        return $this->hasMany(SarprasRuang::class, 'organisation_id', 'organisation_id');
    }

    public function bangunans()
    {
        return $this->hasMany(SarprasBangunan::class, 'organisation_id', 'organisation_id');
    }
}
