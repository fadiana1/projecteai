<?php

namespace App\Models\V1;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $guarded;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function bukti()
    {
        return $this->hasOne(Konfirmasi::class, 'order_id', 'id');
    }
}
