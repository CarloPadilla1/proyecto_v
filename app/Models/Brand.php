<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $primaryKey = 'id_brand';
    protected $fillable = [
        'name_brand',
        'description'
    ];
    public $timestamps = false;

    //Relaciones
    // public function products(){
    //     return $this->hasMany(Product::class,'id_brand','id_brand');
    // }
    public function products(){
        return $this->hasMany(Product::class, 'id_brand', 'id_brand');
    }
}
