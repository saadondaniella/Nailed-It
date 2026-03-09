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

        @if ($products->count())
        @foreach ($products as $product)
        @include('partials.product-card', [
        'product' => $product,
        'showCategory' => false,
        ])
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