<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function scopeSearch($query, array $filters)
    {
        // Version 1
        // if (isset($filters['search']) ? $filters['search'] : false) {
        //     return $query->where('name', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('description', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('product_type', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('price', 'like', '%' . $filters['search'] . '%');
        // }

        // Version 2
        // All Product
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('product_type', 'like', '%' . $search . '%')
                ->orWhere('price', 'like', '%' . $search . '%');
        });

        // By Category
        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('short_name', $category);
            });
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
