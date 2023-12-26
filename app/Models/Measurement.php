<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;
    protected $table = 'measurements';
    protected $primaryKey = 'id_measurements';
    protected $fillable = [
        'measurement'
    ];
}
