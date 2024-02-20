<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Ketentuan extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'desc',
        'category',
        'type',
        'is_required',
        'ketentuan_type',
        'ketentuan_id',
    ];

    public function sluggable(): array
    {
        return [
            'key' => [
                'separator' => '_',
                'source' => 'name'
            ]
        ];
    }

    public $timestamps = false;

    public function ketentuan()
    {
        return $this->morphTo('ketentuan', 'ketentuan_type', 'ketentuan_id');
    }
}
