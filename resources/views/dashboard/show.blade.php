@extends('layouts.app')

@section('title', 'Category — ' . $category->name)

@section('content')
<div class="layout">
    <aside class="sidebar">
        @include('partials.filter-form', [
        'action' => route('dashboard.show', $category),
        'resetUrl' => route('dashboard.show', $category),
        'showCategoryFilter' => false,
        'hiddenFields' => [],
        ])
    </aside>

    <main class="main">
        <h1>{{ $category->name }}</h1>

        {{-- PRODUCT LIST --}}
        @if ($products->count())
        @foreach ($products as $product)
        <div class="product-card">
            <h3>{{ $product->name }}</h3>

            <p>{{ $product->description }}</p>

            <p>
                Color: {{ $product->color }}<br>
                Price: {{ $product->price }} kr <br>
                Stock: {{ $product->stock }}
            </p>

            {{-- EDIT --}}
            <a
                href="{{ route('products.edit', $product) }}"
                class="editButton"
                aria-label="Edit {{ $product->name }}">
                Edit
            </a>

            {{-- DELETE --}}
            <form
                action="{{ route('products.destroy', $product) }}"
                method="POST"
                class="inline-form"
                onsubmit="return confirm('Delete {{ addslashes($product->name) }}?');">
                @csrf
                @method('DELETE')
                <button type="submit" aria-label="Delete {{ $product->name }}">Delete</button>
            </form>
        </div>
        @endforeach
        @else
        <p>No products in this category.</p>
        @endif

        @if (isset($products) && $products->hasPages())
        <div class="pagination">
            {{ $products->links() }}
        </div>
        @endif

        <p>
            <a href="{{ route('dashboard.index') }}">
                Back to dashboard
            </a>
        </p>
    </main>
</div>
@endsection