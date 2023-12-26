<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleLine extends Model
{
    use HasFactory;
    protected $table = 'sale_line';
    protected $primaryKey = 'id_sale_line';
    protected $fillable = [
        'id_sell',
        'id_product',
        'quantity',
        'amount',
    ];

    public $timestamps = false;

    public function sell()
    {
        return $this->belongsTo(Sell::class, 'sell', 'id_sell');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}
