@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-3 text-center">Edit Product</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.update', $product) }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    {{-- Name --}}
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name"
                               class="form-control"
                               value="{{ old('name', $product->name) }}" required>
                    </div>

                    {{-- Details --}}
                    <div class="mb-3">
                        <label class="form-label">Details</label>
                        <textarea name="details" class="form-control" rows="3" required>{{ old('details', $product->details) }}</textarea>
                    </div>

                    {{-- Category --}}
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="category"
                               class="form-control"
                               value="{{ old('category', $product->category) }}" required>
                    </div>

                    {{-- Subcategory --}}
                    <div class="mb-3">
                        <label class="form-label">Subcategory</label>
                        <input type="text" name="subcategory"
                               class="form-control"
                               value="{{ old('subcategory', $product->subcategory) }}" required>
                    </div>

                    {{-- Code --}}
                    <div class="mb-3">
                        <label class="form-label">Product Code</label>
                        <input type="text" name="code"
                               class="form-control"
                               value="{{ old('code', $product->code) }}">
                    </div>

                    {{-- Price --}}
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price"
                               class="form-control"
                               value="{{ old('price', $product->price) }}">
                    </div>

                    {{-- Available --}}
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox"
                               name="availabe_for_sale" id="availabe_for_sale"
                               {{ old('availabe_for_sale', $product->availabe_for_sale) ? 'checked' : '' }}>
                        <label class="form-check-label" for="availabe_for_sale">
                            Available for Sale
                        </label>
                    </div>

                    {{-- Image --}}
                    <div class="mb-3">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="image" class="form-control">
                        @if($product->image)
                            <small class="text-muted">Current image will be kept if not changed</small>
                        @endif
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Update Product
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
