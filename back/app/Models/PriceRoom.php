<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceRoom extends Model
{
    use HasFactory;

    protected $table = 'price_rooms';

    protected $fillable = ['type_id', 'room_id', 'price_high', 'price_low'];

    public function type()
    {
        return $this->belongsTo(Types::class, 'type_id');
    }

    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }
}
