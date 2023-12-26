<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    protected $fillable =[
        'name_product',
        'description',
        'id_category',
        'id_provider',
        'id_brand',
    ];
    public $timestamps = false;

    //Relaciones
    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'product_category', 'id_product', 'id_category');
    }

    public function provider()
    {
        return $this->belongsTo(Providers::class, 'id_provider', 'id_provider');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'id_brand', 'id_brand');
    }

    public function inventory(){
        return $this->hasOne(Inventory::class, 'id_product', 'id_product');
    }
}
