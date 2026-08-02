<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['nama', 'posisi', 'shift', 'departemen_id', 'foto'];
    protected $guarded = ['id'];

    public function departemen() {
        return $this->belongsTo(Departemen::class);
    }
}
