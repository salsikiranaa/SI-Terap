<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class mRole extends Model
{
    use HasFactory;
    protected $table = 'm_role';
    protected $guarded = [];

    public function user() : HasMany {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
