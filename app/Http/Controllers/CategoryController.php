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
        $view = $request->query('view', 'categories');
        $categories = Category::orderBy('name')->get();
        $products = null;

        if ($view === 'products') {

            $products = Product::with('category')
                ->filter($request)
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
        $products = $category->products()
            ->filter($request)
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
