<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Layanan extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'estimasi',
        'desc',
        'is_active'
    ];

    public function ketentuans(): MorphMany
    {
        return $this->morphMany(Ketentuan::class, 'ketentuan', 'ketentuan_type', 'ketentuan_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('name', 'like', $term)
                ->orWhere('desc', 'like', $term);
        });
    }
}
