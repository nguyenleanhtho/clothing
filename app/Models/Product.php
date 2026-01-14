<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    //
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'slug', 'description', 'price', 'stock'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name') && empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * Lấy ảnh đầu tiên của sản phẩm
     */
    public function getPrimaryImageAttribute()
    {
        return $this->firstImage();
    }

    /**
     * Lấy ảnh đầu tiên của sản phẩm
     */
    public function firstImage()
    {
        return $this->images()->first();
    }
}