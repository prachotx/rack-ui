<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CheckOut extends Model
{
    use HasFactory;    
    public function check_out_details(): HasMany
    {
        return $this->hasMany(CheckOutDetail::class);
    }
    protected $fillable=[
        'out_date',
        'code',
        'remark',
        'out_user_id',
        'approve_user_id',
        'status',
    ];
}
