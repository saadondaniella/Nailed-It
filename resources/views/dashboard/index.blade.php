@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="layout">
    <aside class="sidebar">

        {{-- CATEGORIES VIEW --}}
        @if ($view === 'categories')
        <h2>Categories</h2>

        @if ($categories->count())
        <ul>
            @foreach ($categories as $category)
            <li>
                <a href="{{ route('dashboard.show', $category) }}">{{ $category->name }}</a>
                — {{ $category->products()->count() }} products
            </li>
            @endforeach
        </ul>
        @else
        <p>No categories found.</p>
        @endif
        @endif

        {{-- PRODUCTS VIEW (controls) --}}
        @if ($view === 'products')
        <h2>Filter products</h2>

        <form method="GET" action="{{ route('dashboard.index') }}" class="filter-form" aria-labelledby="filter-heading">

            <div class="form-group">
                <label for="search">Search name</label>
                <div id="search-help">Enter part or full product name.</div>
                <input id="search" type="text" name="search" placeholder="Search name..." value="{{ request('search') }}" aria-describedby="search-help">
                
                @error('search')
                <p class="error" role="alert" aria-live="polite">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id">
                    <option value="">All categories</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category_id')==$category->id)>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="min_price">Minimum price (kr)</label>
                <div id="price-help">Use decimals with a dot, e.g. 19.99.</div>
                <input id="min_price" type="number" name="min_price" placeholder="Min price" value="{{ request('min_price') }}" step="0.01" aria-describedby="price-help">
                @error('min_price')
                <p class="error" role="alert" aria-live="polite">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="max_price">Maximum price (kr)</label>
                <input id="max_price" type="number" name="max_price" placeholder="Max price" value="{{ request('max_price') }}" step="0.01" aria-describedby="price-help">
                @error('max_price')
                <p class="error" role="alert" aria-live="polite">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock_filter">Stock</label>
                <div id="stock-help">Filter products by availability.</div>
                <select id="stock_filter" name="stock_filter" aria-describedby="stock-help">
                    <option value="">All</option>
                    <option value="in_stock" @selected(request('stock_filter')==='in_stock' )>
                        In stock only
                    </option>
                    <option value="out_of_stock" @selected(request('stock_filter')==='out_of_stock' )>
                        Out of stock
                    </option>
                </select>
                @error('stock_filter')
                <p class="error" role="alert" aria-live="polite">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="sort">Sort by</label>
                <select id="sort" name="sort">

                    <option value="name_asc"
                        @selected(request('sort', 'name_asc' )==='name_asc' )>
                        Name (A-Z)
                    </option>

                    <option value="name_desc"
                        @selected(request('sort')==='name_desc' )>
                        Name (Z-A)
                    </option>

                    <option value="price_asc"
                        @selected(request('sort')==='price_asc' )>
                        Price (low → high)
                    </option>

                    <option value="price_desc"
                        @selected(request('sort')==='price_desc' )>
                        Price (high → low)
                    </option>

                    <option value="stock_asc"
                        @selected(request('sort')==='stock_asc' )>
                        Stock (low → high)
                    </option>

                    <option value="stock_desc"
                        @selected(request('sort')==='stock_desc' )>
                        Stock (high → low)
                    </option>

                </select>
            </div>

            <button type="submit">Filter</button>

            <a href="{{ route('dashboard.show', $category) }}" class="reset-link">
                Reset
            </a>
        </form>

            

        @endif
    </aside>

    <main style="flex:1;">

        @if ($view === 'products')

        <h1 class="section-title">All products</h1>

        {{-- PRODUCT LIST --}}
        @if ($products && $products->count())
        @foreach ($products as $product)
        <div class="product-card">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->description }}</p>
            <p>
            Category: {{ $product->category->name }}<br>
            Price: {{ $product->price }} kr<br>
            Stock: {{ $product->stock }}
            </p>

            <a href="{{ route('products.edit', $product) }}" class="editButton" aria-label="Edit {{ $product->name }}">Edit</a>

            <form action="{{ route('products.destroy', $product, false) }}" method="POST" class="inline-form">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </div>
        @endforeach

        {{ $products->links() }}
        @else
        <p>No products found.</p>
        @endif
        @endif
    </main>
</div>

@endsection