<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class OrderDetail extends Model
{
    use HasUuids;

    protected $table = 'order_details';

    protected $fillable = [
        'id',
        'idOrder',
        'idProduct',
        'quantity',
        'price'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function product()
    {
        return $this->belongsTo(Product::class, 'idProduct');
    }
}