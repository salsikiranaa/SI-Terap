<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class mFungsional extends Model
{
    use HasFactory;
    protected $table = 'm_fungsional';
    protected $guarded = [];

    public function penyuluh() : HasMany {
        return $this->hasMany(Penyuluh::class, 'fungsional_id', 'id');
    }
}
