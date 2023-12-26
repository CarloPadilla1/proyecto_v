<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeUser extends Model
{
    use HasFactory;
    protected $table = 'type_users';
    protected $primaryKey = 'id_type_user';
    protected $fillable =[
        'type_user'
    ];


    //relaciones
    public function users()
    {
        return $this->hasMany(User::class, 'id_type_user', 'id_type_user');
    }

}
