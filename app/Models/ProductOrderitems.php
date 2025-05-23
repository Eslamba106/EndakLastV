<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrderitems extends Model
{
    use HasFactory;
    protected $fillable = ['product_order_id', 'inds_product_id', 'quantity', 'price'];

    public function product()
    {
        return $this->belongsTo(indsProduct::class, 'inds_product_id');
    }

    public function order()
    {
        return $this->belongsTo(ProductOrder::class);
    }
}
