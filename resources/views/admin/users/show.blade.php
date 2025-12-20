@extends('admin.layouts.app')

@section('title', 'User Details')

@section('content')

{{-- USER INFO --}}
<div class="card mb-4 shadow-sm">
    <div class="card-body d-flex align-items-center">

        {{-- Logo --}}
        @if($user->logo)
            <img src="{{ asset('storage/'.$user->logo) }}"
                 class="rounded me-3"
                 style="width:70px;height:70px;object-fit:cover;">
        @endif

        <div>
            <h4 class="mb-1">
                {{ $user->store_name }}
                <small class="text-muted">({{ $user->first_name }} {{ $user->last_name }})</small>
            </h4>

            <div class="text-muted">
                📍 {{ $user->country }} - {{ $user->city }} <br>
                📞 {{ $user->phone_number }} |
                💬 {{ $user->whatsapp }} |
                📘 {{ $user->facebook }}
            </div>
        </div>

        <div class="ms-auto text-end">
            <span class="badge {{ $user->activated ? 'bg-success' : 'bg-danger' }}">
                {{ $user->activated ? 'Active' : 'Disabled' }}
            </span>

            {{-- Toggle User Status --}}
            <form action="{{ route('admin.users.toggle', $user) }}" method="POST" class="mt-2">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-sm {{ $user->activated ? 'btn-danger' : 'btn-success' }}">
                    {{ $user->activated ? 'Disable User' : 'Enable User' }}
                </button>
            </form>
        </div>

    </div>
</div>

{{-- FILTER + SEARCH --}}
<form method="GET" class="row g-2 align-items-end mb-3">
    <div class="col-md-5">
        <label class="form-label">Search</label>
        <input type="text"
               name="q"
               value="{{ request('q') }}"
               class="form-control"
               placeholder="Product name or category">
    </div>

    <div class="col-md-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="">All</option>
            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Hidden</option>
        </select>
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary w-100">Filter</button>
    </div>
</form>

{{-- PRODUCTS --}}
@if($products->isEmpty())
    <div class="alert alert-info mb-0">No products found.</div>
@else
<form action="{{ route('admin.products.bulk-toggle') }}" method="POST">
    @csrf
    @method('PATCH')

    {{-- BULK ACTIONS --}}
    <div class="d-flex gap-2 mb-3">
        <button name="action" value="enable" class="btn btn-success btn-sm">
            Enable Selected
        </button>
        <button name="action" value="disable" class="btn btn-danger btn-sm">
            Disable Selected
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th width="30"><input type="checkbox" id="checkAll"></th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        <input type="checkbox" name="products[]" value="{{ $product->id }}">
                    </td>
                    <td>
                        <strong>{{ $product->name }}</strong>
                        <div class="text-muted small">
                            {{ Str::limit($product->details, 50) }}
                        </div>
                    </td>
                    <td>{{ $product->category }} / {{ $product->subcategory }}</td>
                    <td>{{ $product->price ?? '-' }} SYP</td>
                    <td>
                        <span class="badge {{ $product->availabe_for_sale ? 'bg-success' : 'bg-secondary' }}">
                            {{ $product->availabe_for_sale ? 'Active' : 'Hidden' }}
                        </span>
                    </td>
                    <td class="text-end">
                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">View</a>

                        <button type="button" class="btn btn-sm btn-outline-danger"
                                onclick="submitDelete({{ $product->id }})">
                            Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</form>

{{-- PAGINATION --}}
<div class="mt-3 d-flex justify-content-center">
    {{ $products->links('pagination::bootstrap-5') }}
</div>
@endif

{{-- Hidden Delete Form --}}
<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

{{-- SCRIPTS --}}
<script>
document.getElementById('checkAll')?.addEventListener('change', function () {
    document.querySelectorAll('input[name="products[]"]').forEach(cb => cb.checked = this.checked);
});

function submitDelete(productId) {
    if (!confirm('Delete this product?')) return;

    const form = document.getElementById('deleteForm');
    form.action = `/admin/products/${productId}`;
    form.submit();
}
</script>

@endsection
