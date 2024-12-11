<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class mKelasBenih extends Model
{
    use HasFactory;
    protected $table = 'm_kelas_benih';
    protected $guarded = [];

    public function perbenihan() : HasMany {
        return $this->hasMany(Perbenihan::class, 'kelas_benih_id', 'id');
    }
}
