@extends('layouts.app')

@section('title', 'Create product')

@section('content')
<main class="main-content">

    <h1>Create product</h1>

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

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <p>
            <label for="name">Name</label><br>
            <input id="name" type="text" name="name" value="{{ old('name') }}">
        </p>

        <p>
            <label for="description">Description</label><br>
            <textarea id="description" name="description">{{ old('description') }}</textarea>
        </p>

        <p>
            <label for="price">Price</label><br>
            <input id="price" type="number" step="0.01" name="price" value="{{ old('price') }}">
        </p>

        <p>
            <label for="color">Color</label><br>
            <input id="color" type="text" name="color" value="{{ old('color') }}">
        </p>

        <p>
            <label for="stock">Stock</label><br>
            <input id="stock" type="number" name="stock" value="{{ old('stock', 0) }}">
        </p>

        <p>
            <label for="category_id">Category</label><br>
            <select id="category_id" name="category_id">
                <option value="">Choose category...</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id')==$category->id)>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </p>

        <button type="submit">Save</button>
    </form>

    <p><a href="{{ route('dashboard.index') }}">← Back to dashboard</a></p>

</main>
@endsection