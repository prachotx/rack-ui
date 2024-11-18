<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rack extends Model
{
    use HasFactory;
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class);
    }
    protected $fillable=[
        'code',
        'name',
        'location_id',
        'rows',
        'columns',
        'depth',
        'status',
    ];
}
