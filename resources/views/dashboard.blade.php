@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
    <div class="container">

        <h2 class="mb-4">My Dashboard</h2>

        {{-- STATS --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm text-center p-3">
                    <h5>Total Products</h5>
                    <h3>{{ $products->count() }}</h3>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm text-center p-3">
                    <h5>Total Hits</h5>
                    <h3>{{ $totalHits }}</h3>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm text-center p-3">
                    <h5>Top Product</h5>
                    <h6>
                        {{ $topProduct?->name ?? '—' }}
                    </h6>
                    <small>
                        Hits: {{ $topProduct?->hits ?? 0 }}
                    </small>
                </div>
            </div>
        </div>
        <form method="GET" class="mb-3">
            <div class="row g-2 align-items-center">
                <div class="col-md-10">
                    <input type="text" name="q" class="form-control form-control-lg" placeholder="Search your products..."
                        value="{{ request('q') }}">
                </div>

                <div class="col-md-2 d-grid">
                    <button class="btn btn-primary btn-lg">
                        Search
                    </button>
                </div>
            </div>
        </form>

        {{-- PRODUCTS TABLE --}}
        <div class="card shadow-sm">
            <div class="card-header">
                <strong>My Products</strong>
            </div>

            <div class="card-body p-0">
                @if($products->isEmpty())
                    <div class="p-3 text-center text-muted">
                        You have no products yet.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table mb-0 table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Hits</th>
                                    <th>Created</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></td>
                                        <td>{{ $product->category }}</td>
                                        <td>{{ $product->price ?? '-' }}</td>
                                        <td>{{ $product->hits }}</td>
                                        <td>{{ $product->created_at->format('Y-m-d') }}</td>

                                        <td class="text-end">
                                            {{-- EDIT --}}
                                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary">
                                                Edit
                                            </a>

                                            {{-- DELETE --}}
                                            <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection