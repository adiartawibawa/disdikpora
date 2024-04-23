<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PermohonanStatus extends Model
{
    const DIKIRIM = 0;
    const DIPROSES = 1;
    const DIKEMBALIKAN = 2;
    const BERHASIL = 3;
    const GAGAL = 4;

    protected $fillable = [
        'status',
        'note'
    ];

    public function status(): MorphTo
    {
        return $this->morphTo('permohonan', 'permohonan_type', 'permohonan_id');
    }
}
