<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'id_category';
    protected $fillable =[
        'name_category',
        'description'
    ];
    public $timestamps = false;

    //Relaciones
    public function products(){
        return $this->hasMany(Product::class,'id_category','id_category');
    }

}
