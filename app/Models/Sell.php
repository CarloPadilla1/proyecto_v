<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;
    protected $table = 'sells';
    protected $primaryKey = 'sell';
    const UPDATED_AT = null;
    
    protected $fillable = [
        'id_user',
        'total_amount',
    ];
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function sale_line(){
        return $this->hasMany(SaleLine::class, 'id_sell', 'sell');
    }

    // public function sellDay()
    // {
    //     return $this->belongsTo(SellDay::class, 'id_sell_day', 'id_sell_day');
    // }
}
