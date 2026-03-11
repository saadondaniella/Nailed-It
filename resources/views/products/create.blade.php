@extends('layouts.app')

@section('title', 'Create product')

@section('content')
<main class="main-content">

    <h1>Create product</h1>

    @if ($errors->any())
    <div class="error-summary" role="alert">
        <strong>Something went wrong!</strong>
    </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <p>
            <label for="name">Name</label><br>
            <input id="name" type="text" name="name" value="{{ old('name') }}" aria-describedby="name-error">
            @error('name')
            <div id="name-error" role="alert" class="error-message">
                {{ $message }}
            </div>
            @enderror
        </p>

        <p>
            <label for="description">Description</label><br>
            <textarea id="description" name="description" aria-describedby="description-error">{{ old('description') }}</textarea>
            @error('description')
            <div id="description-error" role="alert" class="error-message">
                {{ $message }}
            </div>
            @enderror
        </p>

        <p>
            <label for="price">Price</label><br>
            <input id="price" type="number" step="0.01" name="price" value="{{ old('price') }}" aria-describedby="price-error">
            @error('price')
            <div id="price-error" role="alert" class="error-message">
                {{ $message }}
            </div>
            @enderror
        </p>

        <p>
            <label for="color">Color</label><br>
            <input id="color" type="text" name="color" value="{{ old('color') }}" aria-describedby="color-error">
            @error('color')
            <div id="color-error" role="alert" class="error-message">
                {{ $message }}
            </div>
            @enderror
        </p>

        <p>
            <label for="stock">Stock</label><br>
            <input id="stock" type="number" name="stock" value="{{ old('stock', 0) }}" aria-describedby="stock-error">
            @error('stock')
            <div id="stock-error" role="alert" class="error-message">
                {{ $message }}
            </div>
            @enderror
        </p>

        <p>
            <label for="category_id">Category</label><br>
            <select id="category_id" name="category_id" aria-describedby="category-error">
                <option value="">Choose category...</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id')==$category->id)>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
            @error('category_id')
            <div id="category-error" role="alert" class="error-message">
                {{ $message }}
            </div>
            @enderror
        </p>

        <button type="submit">Save</button>
    </form>

    <p><a href="{{ route('dashboard.index') }}">← Back to dashboard</a></p>

</main>
@endsection