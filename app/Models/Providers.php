<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Providers extends Model
{
    use HasFactory;
    protected $table = 'providers';
    protected $primaryKey = 'id_provider';
    protected $fillable = [
        'name_provider',
        'description'
    ];
    public $timestamps = false;
    //Relaciones
    public function products(){
        return $this->hasMany(Product::class,'id_provider','id_provider');
    }
}
