<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Panduan extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['jenis', 'title', 'content', 'image', 'file', 'step'];
}
