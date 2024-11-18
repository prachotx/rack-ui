<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    public function racks()
    {
        return $this->hasMany(Rack::class);
    }
    protected $fillable=[
        'name'
    ];
}
