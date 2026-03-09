<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'color',
        'stock',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, $request)
    {
        // Search
        $query->when($request->filled('search'), function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%');
        });

        // Category filter (for dashboard)
        $query->when($request->filled('category_id'), function ($q) use ($request) {
            $q->where('category_id', $request->category_id);
        });

        // Price filters
        $query->when($request->filled('min_price'), function ($q) use ($request) {
            $q->where('price', '>=', $request->min_price);
        });

        $query->when($request->filled('max_price'), function ($q) use ($request) {
            $q->where('price', '<=', $request->max_price);
        });

        // Stock filter
        $query->when($request->stock_filter === 'in_stock', function ($q) {
            $q->where('stock', '>', 0);
        });

        $query->when($request->stock_filter === 'out_of_stock', function ($q) {
            $q->where('stock', 0);
        });

        // Sorting
        $allowedSorts = [
            'name_asc' => ['name', 'asc'],
            'name_desc' => ['name', 'desc'],
            'price_asc' => ['price', 'asc'],
            'price_desc' => ['price', 'desc'],
            'stock_asc' => ['stock', 'asc'],
            'stock_desc' => ['stock', 'desc'],
        ];

        $sort = $request->query('sort', 'name_asc');

        if (array_key_exists($sort, $allowedSorts)) {
            [$column, $direction] = $allowedSorts[$sort];
            $query->orderBy($column, $direction);
        }

        return $query;
    }
}
