<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
        'total_money',
        'status',
        'payment_method'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Text label for status
    public function getStatusTextAttribute()
    {
        $labels = [
            'pending'   => 'Chờ xử lý',
            'shipping'  => 'Đang giao',
            'completed' => 'Hoàn thành',
            'cancelled' => 'Đã hủy',
        ];

        return $labels[$this->status] ?? $this->status;
    }

    // Calculated total price (fallback to total_money)
    public function getTotalPriceAttribute()
    {
        if ($this->relationLoaded('details')) {
            return $this->details->sum(fn ($d) => ($d->price * $d->quantity));
        }

        // Compute from DB when not eager loaded
        return $this->details()->get()->sum(fn ($d) => ($d->price * $d->quantity));
    }
}
