<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\Village;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class Sekolah extends Model
{
    use HasUuids, HasSpatial;

    protected $fillable = [
        'npsn',
        'nama',
        'jenjang',
        'status',
        'alamat',
        'village_code',
        'lokasi'
    ];

    protected $appends = [
        'geo_lokasi'
    ];

    protected $casts = [
        'lokasi' => Point::class,
    ];

    public function getGeoLokasiAttribute()
    {
        return $this->lokasi->toJson();
    }

    public function village()
    {
        return $this->hasMany(Village::class, 'code', 'village_code');
    }

    public function gtk()
    {
        return $this->hasMany(Gtk::class, 'id', 'sekolah_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('nama', 'like', $term)
                ->orWhere('jenjang', 'like', $term)
                ->orWhere('status', 'like', $term)
                ->orWhere('alamat', 'like', $term)
                ->orWhereHas('village', function ($query) use ($term) {
                    $query->where('name', 'like', $term);
                });
        });
    }
}
