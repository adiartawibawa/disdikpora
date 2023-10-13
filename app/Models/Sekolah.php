<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\Village;

class Sekolah extends Model
{
    use HasUuids;

    protected $fillable = [
        'npsn',
        'nama',
        'status',
        'alamat',
        'village_code',
        'lokasi'
    ];

    public function village()
    {
        return $this->hasMany(Village::class, 'code', 'village_code');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('nama', 'like', $term)
                ->orWhere('status', 'like', $term)
                ->orWhere('alamat', 'like', $term)
                ->orWhereHas('village', function ($query) use ($term) {
                    $query->where('name', 'like', $term);
                });
        });
    }
}
