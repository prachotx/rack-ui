<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckOutDetail extends Model
{
    use HasFactory;
    public function check_out()
    {
        return $this->belongsTo(CheckOut::class);
    }
    public function packing_detail()
    {
        return $this->belongsTo(PackingDetail::class);
    }
    protected $fillable=[
        'check_out_id',
        'packing_detail_id',
        'quantity',
    ];
}
