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
            <label>Name</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
        </p>

        <p>
            <label>Description</label><br>
            <textarea name="description">{{ old('description') }}</textarea>
        </p>

        <p>
            <label>Price</label><br>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}">
        </p>

        <p>
            <label>Color</label><br>
            <input type="text" name="color" value="{{ old('color') }}">
        </p>

        <p>
            <label>Stock</label><br>
            <input type="number" name="stock" value="{{ old('stock', 0) }}">
        </p>

        <p>
            <label>Category</label><br>
            <select name="category_id">
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

    <p><a href="{{ route('dashboard.index') }}">Back to dashboard</a></p>

</main>
@endsection