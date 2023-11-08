<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Ketentuan extends Model
{
    use Sluggable;

    // protected $table = 'ketentuan';

    public function sluggable(): array
    {
        return [
            'key' => [
                'separator' => '_',
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = [
        'name',
        'desc',
        'category',
        'type',
        'is_required',
        'ketentuan_type',
        'ketentuan_id',
    ];

    public $timestamps = false;

    public function ketentuan()
    {
        return $this->morphTo('ketentuan', 'ketentuan_type', 'ketentuan_id');
    }
}
