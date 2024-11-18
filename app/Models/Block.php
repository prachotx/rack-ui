<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Block extends Model
{
    use HasFactory;
    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }
    public function packing_details(): HasMany
    {
        return $this->hasMany(PackingDetail::class);
    }
    protected $fillable=[
        'code',
        'rack_id',
        'depth',
        'long',
        'height',
        'row_position',
        'column_position',
        'support_weight',
        'remain_height',
    ];
}
