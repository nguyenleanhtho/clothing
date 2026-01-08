<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Product extends Model
{
    use HasUuids;

    protected $table = 'products';

    protected $fillable = [
        'id',
        'idCategory',
        'name',
        'description',
        'price',
        'stock',
        'slug'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function category()
    {
        return $this->belongsTo(Category::class, 'idCategory');
    }
}