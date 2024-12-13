<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class mJenisLab extends Model
{
    use HasFactory;
    protected $table = 'm_jenis_lab';
    protected $guarded = [];

    public function laboratorium() : HasMany {
        return $this->hasMany(Laboratorium::class, 'jenis_lab_id', 'id');
    }
}
