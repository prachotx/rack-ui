<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    public function product_type()
    {
        return $this->belongsTo(ProductType::class);
    }
    
    protected $fillable=[
        'name',
        'code',
        'product_type_id',
        'ref_id',
    ];
}
