<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PackingDetail extends Model
{
    use HasFactory;
    public function packing()
    {
        return $this->belongsTo(Packing::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }  
    public function block()
    {
        return $this->belongsTo(Block::class); 
    }
    public function check_out_details(): HasMany
    {
        return $this->hasMany(CheckOutDetail::class);
    }
    protected $fillable=[
        'packing_id',
        'product_id',
        'block_id',
        'quantity',
        'remain_quantity',
        'ref_no',
    ];
}
