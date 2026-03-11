@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<main class="main-content">

    <h1>Edit Product</h1>

    {{-- Success flash --}}
    @if(session('success'))
    <div class="success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
    <div class="error-summary">
        <strong>Something went wrong:</strong>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PATCH')

        <p>
            <label for="name">Name</label><br>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}">
        </p>

        <p>
            <label for="description">Description</label><br>
            <textarea id="description" name="description">{{ old('description', $product->description) }}</textarea>
        </p>

        <p>
            <label for="price">Price</label><br>
            <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $product->price) }}">
        </p>

        <p>
            <label for="color">Color</label><br>
            <input type="text" id="color" name="color" value="{{ old('color', $product->color) }}">
        </p>

        <p>
            <label for="stock">Stock</label><br>
            <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}">
        </p>

        <p>
            <label for="category_id">Category</label><br>
            <select id="category_id" name="category_id">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </p>

        <button type="submit">Save</button>
    </form>

    <p><a href="{{ route('dashboard.show', $product->category) }}">← Back to products</a></p>

</main>

@endsection