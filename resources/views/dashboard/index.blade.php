@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="layout {{ $view === 'categories' ? 'layout--categories' : '' }}">
    <aside class="sidebar">

        {{-- CATEGORIES VIEW --}}
        @if ($view === 'categories')
        <section class="dash-categories">
            <h2 class="dash-categories__title">Categories</h2>

            @if ($categories->count())
            <div class="dash-categories__grid">
                @foreach ($categories as $category)
                <a class="dash-categories__card" href="{{ route('dashboard.show', $category) }}">
                    @php
                    $iconMap = [
                    'Building Materials' => 'building.png',
                    'Electrical' => 'electrical.png',
                    'Garden' => 'garden.png',
                    'Paint' => 'paint.png',
                    'Plumbing' => 'plumbing.png',
                    'Tools' => 'tools.png',
                    ];
                    @endphp

                    <span class="dash-categories__icon">
                        <img
                            src="{{ asset('images/icons/categories/' . ($iconMap[$category->name] ?? 'tools.png')) }}"
                            alt="">
                    </span>

                    <span class="dash-categories__name">{{ $category->name }}</span>
                    <span class="dash-categories__meta">{{ $category->products()->count() }} products</span>
                </a>
                @endforeach
            </div>
            @else
            <p>No categories found.</p>
            @endif
        </section>
        @endif

        {{-- PRODUCTS VIEW (controls) --}}
        @if ($view === 'products')
        @include('partials.filter-form', [
        'action' => route('dashboard.index'),
        'resetUrl' => route('dashboard.index', ['view' => 'products']),
        'showCategoryFilter' => true,
        'categories' => $categories,
        'hiddenFields' => [
        'view' => 'products',
        ],
        ])
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
                Color: {{ $product->color }}<br>
                Category: {{ $product->category->name }}<br>
                Price: {{ $product->price }} kr<br>
                Stock: {{ $product->stock }}
            </p>

            <a
                href="{{ route('products.edit', $product) }}"
                class="editButton"
                aria-label="Edit {{ $product->name }}">
                Edit
            </a>

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