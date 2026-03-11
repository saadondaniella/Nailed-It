<h2 id="filter-heading">Filter products</h2>

@if (session('success'))
<p class="success" role="status">{{ session('success') }}</p>
@endif

<form method="GET" action="{{ $action }}" class="filter-form" aria-labelledby="filter-heading">

    @if (!empty($hiddenFields))
    @foreach ($hiddenFields as $name => $value)
    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
    @endforeach
    @endif

    <div class="form-group">
        <label for="search">Search name</label>
        <div id="search-help">Enter part or full product name.</div>
        <input
            id="search"
            type="text"
            name="search"
            placeholder="Search name..."
            value="{{ request('search') }}"
            aria-describedby="search-help">
    </div>

    <div class="form-group">
        <label for="color">Color</label>
        <div id="color-help">Enter color name, e.g. red.</div>
        <input
            id="color"
            type="text"
            name="color"
            placeholder="Color..."
            value="{{ request('color') }}"
            aria-describedby="color-help">
    </div>

    @if (!empty($showCategoryFilter) && !empty($categories))
    <div class="form-group">
        <label for="category_id">Category</label>
        <select id="category_id" name="category_id">
            <option value="">All categories</option>
            @foreach ($categories as $categoryOption)
            <option value="{{ $categoryOption->id }}" @selected(request('category_id')==$categoryOption->id)>
                {{ $categoryOption->name }}
            </option>
            @endforeach
        </select>
    </div>
    @endif

    <div class="form-group">
        <label for="min_price">Minimum price (kr)</label>
        <div id="price-help">Enter price in Swedish kronor.</div>
        <input
            id="min_price"
            type="number"
            name="min_price"
            placeholder="Min price"
            value="{{ request('min_price') }}"
            min="0"
            step="1"
            aria-describedby="price-help">
    </div>

    <div class="form-group">
        <label for="max_price">Maximum price (kr)</label>
        <input
            id="max_price"
            type="number"
            name="max_price"
            placeholder="Max price"
            value="{{ request('max_price') }}"
            min="0"
            step="1"
            aria-describedby="price-help">
    </div>

    <div class="form-group">
        <label for="stock_filter">Stock</label>
        <div id="stock-help">Filter products by availability.</div>
        <select id="stock_filter" name="stock_filter" aria-describedby="stock-help">
            <option value="">All</option>
            <option value="in_stock" @selected(request('stock_filter')==='in_stock')>
                In stock only
            </option>
            <option value="out_of_stock" @selected(request('stock_filter')==='out_of_stock')>
                Out of stock
            </option>
        </select>
    </div>

    <div class="form-group">
        <label for="sort">Sort by</label>
        <select id="sort" name="sort">
            <option value="name_asc" @selected(request('sort', 'name_asc')==='name_asc')>
                Name (A-Z)
            </option>
            <option value="name_desc" @selected(request('sort')==='name_desc')>
                Name (Z-A)
            </option>
            <option value="price_asc" @selected(request('sort')==='price_asc')>
                Price (low → high)
            </option>
            <option value="price_desc" @selected(request('sort')==='price_desc')>
                Price (high → low)
            </option>
            <option value="stock_asc" @selected(request('sort')==='stock_asc')>
                Stock (low → high)
            </option>
            <option value="stock_desc" @selected(request('sort')==='stock_desc')>
                Stock (high → low)
            </option>
        </select>
    </div>

    <button type="submit">Filter</button>

    <a href="{{ $resetUrl }}" class="reset-link">Reset</a>
</form>