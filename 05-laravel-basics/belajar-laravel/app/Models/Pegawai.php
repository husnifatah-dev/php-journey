<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'posisi', 'shift', 'departemen_id'];

    public function departemen() {
        return $this->belongsTo(Departemen::class);
    }
}
