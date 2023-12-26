<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    const CREATED_AT = null;
    protected $table = 'inventory';
    protected $primaryKey = 'id_inventory';
    protected $fillable =[
        'id_product',
        'id_measurements',
        'purchase_price',
        'sale_price',
        'stock',
        'total_expense',
        'quantity_sell',
        'total_revenue',
        'total_profit'
    ];
    protected $attributes = [
        'quantity_sell' => 0,
        'total_expense' => 0.00,
        'total_revenue' => 0.00,
        'total_profit' => 0.00,
    ];

    //Relaciones
    public function product(){
        return $this->hasOne(Product::class, 'id_product', 'id_product');
    }
    public function measurement(){
        return $this->belongsTo(Measurement::class,'id_measurements','id_measurements');
    }

}
