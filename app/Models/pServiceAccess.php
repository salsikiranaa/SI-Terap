<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class pServiceAccess extends Model
{
    use HasFactory;
    protected $table = 'p_service_access';
    protected $guarded = [];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function service() : BelongsTo {
        return $this->belongsTo(mService::class, 'service_id', 'id');
    }
}
