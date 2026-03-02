<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Public category list
     */
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        return view('index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Dashboard overview (categories or all products)
     */
    public function dashboard(Request $request)
    {
        $view = $request->query('view', 'categories'); // categories | products
        $categories = Category::orderBy('name')->get();
        $products = null;

        if ($view === 'products') {

            $productsQuery = Product::query()->with('category');

            // Search
            $productsQuery->when($request->filled('search'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            });

            // Filter by category
            $productsQuery->when($request->filled('category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            });

            // Price filters
            $productsQuery->when($request->filled('min_price'), function ($query) use ($request) {
                $query->where('price', '>=', $request->min_price);
            });

            $productsQuery->when($request->filled('max_price'), function ($query) use ($request) {
                $query->where('price', '<=', $request->max_price);
            });

            // Stock filter
            $productsQuery->when($request->stock_filter === 'in_stock', function ($query) {
                $query->where('stock', '>', 0);
            });

            $productsQuery->when($request->stock_filter === 'out_of_stock', function ($query) {
                $query->where('stock', 0);
            });

            // Sorting
            $sort = $request->query('sort', 'name_asc');

            if ($sort === 'price_asc') {
                $productsQuery->orderBy('price', 'asc');
            } elseif ($sort === 'price_desc') {
                $productsQuery->orderBy('price', 'desc');
            } else {
                $productsQuery->orderBy('name', 'asc');
            }

            $products = $productsQuery
                ->paginate(10)
                ->withQueryString();
        }

        return view('dashboard.index', [
            'view' => $view,
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    /**
     * Show single category with filtered products
     */
    public function show(Request $request, Category $category)
    {
        $productsQuery = $category->products();

        // Search
        $productsQuery->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        });

        // Price filters
        $productsQuery->when($request->filled('min_price'), function ($query) use ($request) {
            $query->where('price', '>=', $request->min_price);
        });

        $productsQuery->when($request->filled('max_price'), function ($query) use ($request) {
            $query->where('price', '<=', $request->max_price);
        });

        // Stock filter
        $productsQuery->when($request->stock_filter === 'in_stock', function ($query) {
            $query->where('stock', '>', 0);
        });

        $productsQuery->when($request->stock_filter === 'out_of_stock', function ($query) {
            $query->where('stock', 0);
        });

        // Sorting
        $sort = $request->query('sort', 'name_asc');

        if ($sort === 'price_asc') {
            $productsQuery->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $productsQuery->orderBy('price', 'desc');
        } else {
            $productsQuery->orderBy('name', 'asc');
        }

        $products = $productsQuery
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.show', [
            'category' => $category,
            'products' => $products,
        ]);
    }

    public function create() {}
    public function store(Request $request) {}
    public function edit(Category $category) {}
    public function update(Request $request, Category $category) {}
    public function destroy(Category $category) {}
}
