<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class mService extends Model
{
    use HasFactory;
    protected $table = 'm_service';
    protected $guarded = [];

    public function user() : BelongsToMany {
        return $this->belongsToMany(User::class, 'm_service_user', 'service_id', 'id');
    }
}
