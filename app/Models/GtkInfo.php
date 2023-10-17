<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GtkInfo extends Model
{
    protected $table = 'gtk_info';

    protected $fillable = [
        'gtk_id',
        'jenis',
        'informasi'
    ];

    public function gtk()
    {
        return $this->belongsTo(Gtk::class);
    }
}
