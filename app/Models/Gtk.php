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

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function scopeSearch($query, $term)
    {
        $term = "%$term%";
        $query->where(function ($query) use ($term) {
            $query->where('nama', 'like', $term)
                ->orWhere('nik', 'like', $term)
                ->orWhere('nuptk', 'like', $term)
                ->orWhere('nip', 'like', $term);
        });
    }
}
