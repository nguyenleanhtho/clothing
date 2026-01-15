<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductImage extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'product_id',
        'img_url'
    ];

    public function getUrlAttribute(): string
    {
        $path = (string) $this->img_url;

        if ($path === '') {
            return '';
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        $path = ltrim($path, '/');

        // Some existing data might already include a storage/public prefix.
        if (Str::startsWith($path, 'storage/')) {
            $path = Str::after($path, 'storage/');
        }

        if (Str::startsWith($path, 'public/')) {
            $path = Str::after($path, 'public/');
        }

        return Storage::disk('public')->url($path);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
