<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Social extends Model
{
    use HasFactory;
    protected $table = 'social';
    protected $guarded = [];

    public function created_by() : BelongsTo {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updated_by() : BelongsTo {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
