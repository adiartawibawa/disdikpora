<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Gtk extends Model
{

    use HasUuids;

    protected $fillable = [
        'nama',
        'nik',
        'nuptk',
        'nip',
        'sex',
        'tempat_lahir',
        'tanggal_lahir',
        'status_tugas',
        'status_kepegawaian',
        'is_kepsek',
        'no_telp',
        'sekolah_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function informasi()
    {
        return $this->hasMany(GtkInfo::class);
    }
}
