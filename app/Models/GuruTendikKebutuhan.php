<?php

namespace App\Models;

use App\Concerns\Multitenantable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GuruTendikKebutuhan extends Model
{
    use Multitenantable;
    use HasUuids;

    protected $fillable = [
        'organisation_id',
        'jenis_ptk_id',
        'asn',
        'non_asn',
        'jml_sekarang',
        'jml_kurang',
        'active',
        'keterangan'
    ];

    public function jenisPtk(): BelongsTo
    {
        return $this->belongsTo(JenisPtk::class, 'jenis_ptk_id', 'id');
    }
}
