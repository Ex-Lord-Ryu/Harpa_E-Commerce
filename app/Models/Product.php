<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'featured',
        'stock_quantity',
        'track_inventory'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'featured' => 'boolean',
        'stock_quantity' => 'integer',
        'track_inventory' => 'boolean'
    ];

    /**
     * Check if the product is in stock
     */
    public function inStock()
    {
        return !$this->track_inventory || $this->stock_quantity > 0;
    }

    /**
     * Get the stock status text
     */
    public function getStockStatusAttribute()
    {
        if (!$this->track_inventory) {
            return 'Tersedia';
        }

        if ($this->stock_quantity > 10) {
            return 'Tersedia';
        } elseif ($this->stock_quantity > 0) {
            return 'Stok Terbatas';
        } else {
            return 'Habis';
        }
    }
}
