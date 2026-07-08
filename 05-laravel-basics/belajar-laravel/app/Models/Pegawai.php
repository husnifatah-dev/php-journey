<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = ['nama', 'posisi', 'shift', 'departemen_id'];

    public function departemen() {
        return $this->belongsTo(Departemen::class);
    }
}
