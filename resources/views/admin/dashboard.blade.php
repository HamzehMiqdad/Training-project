@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

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


<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
@foreach($products as $product)
    <div class="col">
        <div class="card h-100 shadow-sm">

            {{-- Image --}}
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}"
                     class="card-img-top"
                     style="height:200px; object-fit:cover;">
            @endif

            <div class="card-body">
                <h5>{{ $product->name }}</h5>

                <p class="text-muted small mb-1">
                    Store: <strong>{{ $product->user->store_name }}</strong>
                </p>

                <p class="mb-1">
                    <td>
                        <a href="/admin/users/{{ $product->user->id }}"
                        class="text-decoration-none fw-semibold">
                            {{ $product->user->first_name }} {{ $product->user->last_name }}
                        </a>
                    </td>
                </p>

                <p class="mb-1">
                    Hits: <strong>{{ $product->hits }}</strong>
                </p>

                <span class="badge {{ $product->availabe_for_sale ? 'bg-success' : 'bg-danger' }}">
                    {{ $product->availabe_for_sale ? 'Available' : 'Not Available' }}
                </span>
            </div>

            <div class="card-footer d-flex justify-content-between">
                <form action="{{ route('admin.products.toggle', $product) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-warning btn-sm">
                        Toggle
                    </button>
                </form>

                <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        Delete
                    </button>
                </form>
            </div>

        </div>
    </div>
@endforeach
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $products->links('pagination::bootstrap-5') }}
</div>
@endsection
