<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Packing extends Model
{
    use HasFactory;
    public function packing_details(): HasMany
    {
        return $this->hasMany(PackingDetail::class);
    }
    protected $fillable=[
        'pack_date',
        'code',
        'remark',
        'pack_user_id',
        'approve_user_id',
        'status',
    ];
}
