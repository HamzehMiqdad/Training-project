@extends('layouts.app')
@section('title', '')

@section('content')

    {{-- TOP AD --}}
    @if($ad_top)
        <div class="mb-4">
            <a href="{{ route('ads.click', $ad_top) }}" target="_blank" class="d-block">
                <img src="{{ asset('storage/' . $ad_top->image) }}" alt="Advertisement" class="w-100 rounded shadow-sm"
                    style="height: 180px; object-fit: cover;">
                <small class="d-block text-end text-muted mt-1">Advertisement</small>
            </a>
        </div>
    @endif

    {{-- FILTER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="mb-3 mb-md-0">@yield('title')</h2>

        <form method="GET" class="row g-2 align-items-center flex-grow-1 ms-3">
            <div class="col-12 col-md-4">
                <input type="text" name="q" class="form-control form-control-lg rounded-pill"
                    placeholder="Search products..." value="{{ request('q') }}">
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
                    <i class="bi bi-search"></i> Filter
                </button>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="{{ $ad_sidebar ? 'col-lg-9' : 'col-12' }}">

            {{-- SHOW SECTIONS ONLY IF NO FILTER --}}
            @if(!request()->filled('q') && !request()->filled('category') && !request()->filled('subcategory'))

                {{-- TOP CATEGORIES --}}
                <div class="mb-5">
        <h3 class="mb-4">Top Categories</h3>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($topCategories as $category)
                @php
                    $sampleProduct = \App\Models\Product::where('category', $category)
                                        ->where('availabe_for_sale', true)
                                        ->inRandomOrder()
                                        ->first();
                @endphp
                <div class="col">
                    <a href="{{ route('products.index', ['category' => $category]) }}" class="text-decoration-none">
                        <div class="card shadow-sm h-100 text-center p-3">
                            @if($sampleProduct && $sampleProduct->image)
                                <div class="category-img mb-3 d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('storage/' . $sampleProduct->image) }}" 
                                         alt="{{ $category }}" class="img-fluid" style="max-height:180px; width:100%; object-fit:cover; border-radius:8px;">
                                </div>
                            @else
                                <div class="category-img mb-3 d-flex align-items-center justify-content-center" style="height:180px; background:#eee; border-radius:8px;">
                                    <span class="align-middle">{{ $category }}</span>
                                </div>
                            @endif
                            <p class="mb-0 fw-bold text-dark">{{ $category }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

                {{-- TOP PRODUCTS --}}
                <div class="mb-4">
                    <h3 class="mb-3">Top Products</h3>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($topProducts as $product)
                            @include('partials.product-card', ['product' => $product])
                        @endforeach
                    </div>
                </div>

                {{-- NEW PRODUCTS --}}
                <div class="mb-4">
                    <h3 class="mb-3">New Products</h3>
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($newProducts as $product)
                            @include('partials.product-card', ['product' => $product])
                        @endforeach
                    </div>
                </div>

            @endif

            {{-- MAIN PRODUCTS --}}
            <div class="mb-4">
                <h3 class="mb-3">Products</h3>
                @if($products->isEmpty())
                    <div class="alert alert-info">No Products Found</div>
                @else
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($products as $product)
                            @include('partials.product-card', ['product' => $product])
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>

        {{-- SIDEBAR AD --}}
        @if($ad_sidebar)
            <div class="col-lg-3 d-none d-lg-block">
                <div class="ad-sidebar sticky-top p-3 bg-white rounded shadow-sm mb-4">
                    <a href="{{ route('ads.click', $ad_sidebar) }}" target="_blank">
                        <img src="{{ asset('storage/' . $ad_sidebar->image) }}" alt="Advertisement" class="w-100 rounded"
                            style="height:420px; object-fit:contain;">
                    </a>
                    <small class="d-block text-end text-muted mt-1">Advertisement</small>
                </div>
            </div>
        @endif
    </div>

    {{-- BOTTOM AD --}}
    @if($ad_bottom)
        <div class="mt-4">
            <a href="{{ route('ads.click', $ad_bottom) }}" target="_blank" class="d-block">
                <img src="{{ asset('storage/' . $ad_bottom->image) }}" class="w-100 rounded shadow-sm" alt="Advertisement"
                    style="height: 180px; object-fit: cover;">
                <small class="d-block text-end text-muted mt-1">Advertisement</small>
            </a>
        </div>
    @endif

    {{-- STYLES --}}
    <style>
        .product-details {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;

        }
.category-img img {
            object-fit: contain;
            width: 100%;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            transition: all 0.2s;
        }
    </style>

@endsection