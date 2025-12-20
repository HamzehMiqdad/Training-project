@section('content')
@if($ad_top)
    <a href="{{ route('ads.click',$ad_top) }}" target="_blank" class="ad-top mb-3 d-block">
        <img src="{{ asset('storage/' . $ad_top->image) }}" alt="Ad"
             style="width: 100%; height: 150px; object-fit: cover; border-radius: 6px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <small class="ad-label-top">Advertisement</small>
    </a>
@endif
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
    
    <h2 class="mb-2 mb-md-0">@yield('title')</h2>
                <form method="GET" class="row g-2 align-items-center mb-4">

                {{-- Search --}}
                <div class="col-12 col-md-4">
                    <input type="text" name="q"
                        class="form-control form-control-lg rounded-pill"
                        placeholder="Search products..."
                        value="{{ request('q') }}">
                </div>

                {{-- Category --}}
                <div class="col-6 col-md-3">
                    <select name="category" class="form-select form-select-lg rounded-pill">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}"
                                {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Subcategory --}}
                <div class="col-6 col-md-3">
                    <select name="subcategory" class="form-select form-select-lg rounded-pill">
                        <option value="">All Subcategories</option>
                        @foreach($subcategories as $subcategory)
                            <option value="{{ $subcategory }}"
                                {{ request('subcategory') == $subcategory ? 'selected' : '' }}>
                                {{ $subcategory }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Submit --}}
                <div class="col-12 col-md-2 d-grid">
                    <button class="btn btn-primary btn-lg rounded-pill">
                        <i class="bi bi-search"></i> Filter
                    </button>
                </div>

            </form>

</div>




@if($products->isEmpty())
    <div class="alert alert-info">No Products</div>
@else
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($products as $product)
            <div class="col">
    <div class="card h-100 shadow-sm d-flex flex-column">
        {{-- الجزء العلوي clickable --}}
        <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark flex-grow-1">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height:200px; object-fit:cover;">
            @else
                <img src="https://via.placeholder.com/400x200?text=No+Image" class="card-img-top" alt="No Image">
            @endif

            <div class="card-body d-flex flex-column flex-grow-1">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text mb-2" style="
                    display: -webkit-box;
                    -webkit-line-clamp: 1;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                ">{{ $product->details }}</p>
                <p class="mb-1"><strong>Category:</strong> {{ $product->category }} / {{ $product->subcategory }}</p>
                @if($product->price)
                    <p class="mb-1"><strong>Price:</strong>  {{ $product->price }}  SYP</p>
                @endif
                <p>
                    <span class="badge {{ $product->availabe_for_sale ? 'bg-success' : 'bg-danger' }}">
                        {{ $product->availabe_for_sale ? 'Available' : 'Not Available' }}
                    </span>
                </p>
            </div>
        </a>

        {{-- Buttons فقط أسفل الكارد --}}
        <div class="card-body d-flex justify-content-between mt-auto">
            @can('edit', $product)
                <a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-sm">Edit</a>
            @endcan
            @can('destroy', $product)
                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            @endcan
        </div>

        <div class="card-footer text-muted text-end">
            Added on {{ $product->created_at->format('M d, Y') }}
        </div>
    </div>
</div>

        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
@endif

@if($ad_bottom)
    <a href="{{ route('ads.click',$ad_top) }}" target="_blank" class="ad-bottom mt-3 d-block">
        <img src="{{ asset('storage/' . $ad_bottom->image) }}" alt="Ad"
             style="width: 100%; height: 150px; object-fit: cover; border-radius: 6px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <small class="ad-label-bottom">Advertisement</small>
    </a>
@endif
<style>
.ad-top .ad-label-top,
.ad-sidebar .ad-label-sidebar,
.ad-bottom .ad-label-bottom {
    display: block;
    text-align: right;
    font-size: 0.75rem;
    color: #666;
    margin-top: 2px;
}
</style>

@endsection