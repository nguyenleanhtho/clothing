<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasUuids;

    protected $table = 'orders';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'idUser',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function items()
    {
        return $this->hasMany(OrderDetail::class, 'idOrder');
    }

    public function getStatusLabelAttribute()
    {
        return [
            'pending'    => 'Chờ xử lý',
            'processing' => 'Đang xử lý',
            'completed'  => 'Hoàn thành',
            'cancelled'  => 'Đã hủy',
        ][$this->status] ?? $this->status;
    }

    public function getTotalAmountAttribute()
    {
        return $this->items->sum(function($item){
            return $item->price * $item->quantity;
        });
    }
}
