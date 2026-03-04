@extends('layouts.app')

@section('title', 'Category — ' . $category->name)

@section('content')
<div class="layout">
    <aside class="sidebar">
        <h2 id="filter-heading">Filter products</h2>
        @if (session('success'))
        <p class="success">{{ session('success') }}</p>
        @endif

        <form method="GET" action="{{ route('dashboard.show', $category) }}" class="filter-form" aria-labelledby="filter-heading">

            <div class="form-group">
                <label for="search">Search name</label>
                <div id="search-help">Enter part or full product name.</div>
                <input id="search" type="text" name="search" placeholder="Search name..." value="{{ request('search') }}" aria-describedby="search-help">

                @error('search')
                <p class="error" role="alert" aria-live="polite">{{ $message }}</p>
                @enderror
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
    </aside>

    <main class="main">
        <h1>{{ $category->name }}</h1>

        @if($products->count())

        @foreach($products as $product)
        <div class="product-card">

            <h3>{{ $product->name }}</h3>

            <p>{{ $product->description }}</p>

            <p>
                Price: {{ $product->price }} kr <br>
                Stock: {{ $product->stock }}
            </p>

            {{-- EDIT --}}
            <a href="{{ route('products.edit', $product) }}" class="editButton" aria-label="Edit {{ $product->name }}">
                Edit
            </a>

            {{-- DELETE --}}
            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline-form" onsubmit="return confirm('Delete {{ addslashes($product->name) }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" aria-label="Delete {{ $product->name }}">Delete</button>
            </form>

        </div>
        @endforeach

        @else
        <p>No products in this category.</p>
        @endif

        <p>
            <a href="{{ route('dashboard.index') }}">
                Back to dashboard
            </a>
        </p>

    </main>

</div>

@endsection