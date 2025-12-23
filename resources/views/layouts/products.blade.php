
@section('title', 'Products')

@section('content')

{{-- TOP AD --}}
@if($ad_top)
    <a href="{{ route('ads.click', $ad_top) }}" target="_blank" class="d-block mb-4">
        <img src="{{ asset('storage/' . $ad_top->image) }}"
             alt="Advertisement"
             class="ad-top-img">
        <span class="ad-label-top">Advertisement</span>
    </a>
@endif

{{-- TITLE + FILTER --}}
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
    <h2 class="mb-3 mb-md-0">@yield('title')</h2>

    <form method="GET" class="row g-2 align-items-center">
        <div class="col-12 col-md-4">
            <input type="text" name="q"
                   class="form-control form-control-lg rounded-pill"
                   placeholder="Search products..."
                   value="{{ request('q') }}">
        </div>

        <div class="col-6 col-md-3">
            <select name="category" class="form-select form-select-lg rounded-pill">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-6 col-md-3">
            <select name="subcategory" class="form-select form-select-lg rounded-pill">
                <option value="">All Subcategories</option>
                @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory }}" {{ request('subcategory') == $subcategory ? 'selected' : '' }}>
                        {{ $subcategory }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-12 col-md-2 d-grid">
            <button class="btn btn-primary btn-lg rounded-pill">
                Filter
            </button>
        </div>
    </form>
</div>

{{-- CONTENT + SIDEBAR --}}
<div class="row">

    {{-- PRODUCTS --}}
    <div class="{{ $ad_sidebar ? 'col-lg-9' : 'col-12' }}">
        @if($products->isEmpty())
            <div class="alert alert-info">No Products</div>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach($products as $product)
                    <div class="col">
                        <div class="card h-100 shadow-sm d-flex flex-column">

                            {{-- CLICKABLE AREA --}}
                            <a href="{{ route('products.show', $product) }}"
                               class="text-decoration-none text-dark flex-grow-1">

                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                         class="card-img-top"
                                         style="height:200px; object-fit:cover;">
                                @else
                                    <img src="https://via.placeholder.com/400x200?text=No+Image"
                                         class="card-img-top">
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $product->name }}</h5>

                                    <p class="card-text text-muted mb-2 product-details">
                                        {{ $product->details }}
                                    </p>

                                    <p class="mb-1">
                                        <strong>Category:</strong>
                                        {{ $product->category }} / {{ $product->subcategory }}
                                    </p>

                                    @if($product->price)
                                        <p class="mb-1">
                                            <strong>Price:</strong> {{ $product->price }} SYP
                                        </p>
                                    @endif

                                    <span class="badge {{ $product->availabe_for_sale ? 'bg-success' : 'bg-danger' }}">
                                        {{ $product->availabe_for_sale ? 'Available' : 'Not Available' }}
                                    </span>
                                </div>
                            </a>

                            {{-- ACTIONS --}}
                            <div class="card-body d-flex justify-content-between mt-auto">
                                @can('edit', $product)
                                    <a href="{{ route('products.edit', $product) }}"
                                       class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                @endcan

                                @can('destroy', $product)
                                    <form action="{{ route('products.destroy', $product) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>
                                @endcan
                            </div>

                            <div class="card-footer text-muted text-end">
                                {{ $product->created_at->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

    {{-- SIDEBAR AD --}}
    @if($ad_sidebar)
        <div class="col-lg-3 d-none d-lg-block">
            <div class="ad-sidebar sticky-top">
                <a href="{{ route('ads.click', $ad_sidebar) }}" target="_blank">
                    <img src="{{ asset('storage/' . $ad_sidebar->image) }}" alt="Advertisement">
                </a>
                <span class="ad-label-sidebar">Advertisement</span>
            </div>
        </div>
    @endif
</div>

{{-- BOTTOM AD --}}
@if($ad_bottom)
    <a href="{{ route('ads.click', $ad_bottom) }}" target="_blank" class="d-block mt-4">
        <img src="{{ asset('storage/' . $ad_bottom->image) }}"
             class="ad-bottom-img"
             alt="Advertisement">
        <span class="ad-label-bottom">Advertisement</span>
    </a>
@endif

{{-- STYLES --}}
<style>
.product-details {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.ad-top-img,
.ad-bottom-img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.ad-sidebar {
    background: #fff;
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    text-align: center;
}

.ad-sidebar img {
    width: 100%;
    height: 420px;
    object-fit: contain;
    border-radius: 8px;
}

.ad-label-top,
.ad-label-sidebar,
.ad-label-bottom {
    display: block;
    text-align: right;
    font-size: 0.75rem;
    color: #888;
    margin-top: 4px;
}

</style>

@endsection
