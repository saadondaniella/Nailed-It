<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('name')->get();

        return view('index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Dashboard listing for categories.
     */
    public function dashboard()
    {
        $categories = Category::orderBy('name')->get();

        return view('dashboard.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Category $category)
    {
        $productsQuery = $category->products(); // OBS: query builder, inte ->products

        $productsQuery->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->query('search') . '%');
        });

        $productsQuery->when($request->filled('min_price'), function ($query) use ($request) {
            $query->where('price', '>=', $request->query('min_price'));
        });

        $productsQuery->when($request->filled('max_price'), function ($query) use ($request) {
            $query->where('price', '<=', $request->query('max_price'));
        });

        $productsQuery->when($request->boolean('in_stock'), function ($query) {
            $query->where('stock', '>', 0);
        });

        // Sortering
        $sort = $request->query('sort', 'name_asc');
        if ($sort === 'price_asc') {
            $productsQuery->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $productsQuery->orderBy('price', 'desc');
        } else {
            $productsQuery->orderBy('name', 'asc');
        }

        $products = $productsQuery->get(); // eller paginate (se steg 3)

        return view('dashboard.show', [
            'category' => $category,
            'products' => $products,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
