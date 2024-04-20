<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PermohonanStatus extends Model
{

    public function status(): MorphTo
    {
        return $this->morphTo('permohonan', 'permohonan_type', 'permohonan_id');
    }
}
