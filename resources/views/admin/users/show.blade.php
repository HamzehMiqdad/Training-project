@extends('admin.layouts.app')

@section('title', 'User Details')

@section('content')
<div class="flex flex-col gap-8">
    {{-- User Info Card --}}
    <div class="bg-white dark:bg-[#32311b] rounded-xl p-6 shadow-sm border border-[#e6e6db] dark:border-[#3a392a]">
        <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
            @if($user->logo)
                <img src="{{ asset('storage/'.$user->logo) }}" alt="{{ $user->store_name }}" class="size-20 rounded-xl object-cover border border-[#e6e6db] dark:border-[#3a392a]"/>
            @else
                <div class="size-20 rounded-xl bg-primary/20 flex items-center justify-center border border-[#e6e6db] dark:border-[#3a392a]">
                    <span class="material-symbols-outlined text-4xl text-primary">storefront</span>
                </div>
            @endif

            <div class="flex-1">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-black text-[#181811] dark:text-white mb-1">{{ $user->store_name }}</h2>
                        <p class="text-sm text-[#8c8b5f] dark:text-[#a1a18d]">{{ $user->first_name }} {{ $user->last_name }}</p>
                    </div>
                    <div class="flex flex-col items-start md:items-end gap-2">
                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $user->activated ? 'bg-green-500/20 text-green-700 dark:text-green-400' : 'bg-red-500/20 text-red-700 dark:text-red-400' }}">
                            {{ $user->activated ? 'Active' : 'Disabled' }}
                        </span>
                        <form action="{{ route('admin.users.toggle', $user) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="h-10 px-4 rounded-xl font-bold text-sm transition-colors {{ $user->activated ? 'bg-red-500/20 hover:bg-red-500/30 text-red-600 dark:text-red-400' : 'bg-green-500/20 hover:bg-green-500/30 text-green-600 dark:text-green-400' }} flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-lg">{{ $user->activated ? 'block' : 'check_circle' }}</span>
                                <span>{{ $user->activated ? 'Disable User' : 'Enable User' }}</span>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="mt-4 flex flex-wrap gap-4 text-sm text-[#8c8b5f] dark:text-[#a1a18d]">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">location_on</span>
                        <span>{{ $user->country }} - {{ $user->city }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">phone</span>
                        <span>{{ $user->phone_number }}</span>
                    </div>
                    @if($user->whatsapp)
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-base">chat</span>
                            <span>{{ $user->whatsapp }}</span>
                        </div>
                    @endif
                    @if($user->facebook)
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-base">link</span>
                            <a href="{{ $user->facebook }}" target="_blank" class="hover:text-primary transition-colors">Facebook</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <form method="GET" action="{{ route('admin.users.show', $user) }}" class="flex flex-col gap-4 rounded-3xl bg-white p-4 shadow-sm dark:bg-[#32311b] md:flex-row md:items-center border border-[#e6e6db] dark:border-[#3a392a]">
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-4 flex items-center text-[#8c8b5f]">
                <span class="material-symbols-outlined">search</span>
            </span>
            <input 
                class="h-12 w-full rounded-xl border border-[#e6e6db] bg-[#f8f8f5] pl-12 pr-4 text-base font-medium text-[#181811] placeholder-[#8c8b5f] focus:border-primary focus:ring-0 dark:bg-background-dark dark:border-[#3a392a] dark:text-white" 
                placeholder="Product name or category..."
                name="q"
                value="{{ request('q') }}"
            />
        </div>
        <select name="status" class="h-12 rounded-xl border border-[#e6e6db] bg-[#f8f8f5] px-4 text-base font-medium text-[#181811] focus:border-primary focus:ring-0 dark:bg-background-dark dark:border-[#3a392a] dark:text-white">
            <option value="">All Status</option>
            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Hidden</option>
        </select>
        <button type="submit" class="h-12 px-6 rounded-xl bg-primary hover:bg-[#d9d505] text-[#181811] font-bold transition-colors shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
            <span class="material-symbols-outlined">filter_list</span>
            <span>Filter</span>
        </button>
    </form>

    {{-- Products --}}
    @if($products->isEmpty())
        <div class="text-center py-12 rounded-3xl bg-white dark:bg-[#32311b] border border-[#e6e6db] dark:border-[#3a392a]">
            <p class="text-gray-500 dark:text-gray-400 text-lg">No products found.</p>
        </div>
    @else
        <form action="{{ route('admin.products.bulk-toggle') }}" method="POST">
            @csrf
            @method('PATCH')

            {{-- Bulk Actions --}}
            <div class="flex gap-2 mb-4">
                <button name="action" value="enable" type="submit" class="h-10 px-4 rounded-xl bg-green-500/20 hover:bg-green-500/30 text-green-600 dark:text-green-400 font-bold text-sm transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-lg">check_circle</span>
                    <span>Enable Selected</span>
                </button>
                <button name="action" value="disable" type="submit" class="h-10 px-4 rounded-xl bg-red-500/20 hover:bg-red-500/30 text-red-600 dark:text-red-400 font-bold text-sm transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-lg">block</span>
                    <span>Disable Selected</span>
                </button>
            </div>

            <div class="overflow-hidden rounded-[2rem] border border-[#e6e6db] bg-white shadow-sm dark:bg-[#32311b] dark:border-[#3a392a]">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[1000px] table-fixed">
                        <thead>
                            <tr class="border-b border-[#e6e6db] bg-[#fcfcfb] dark:bg-[#2c2b18] dark:border-[#3a392a]">
                                <th class="w-[50px] px-6 py-4 text-left">
                                    <input type="checkbox" id="checkAll" class="rounded border-[#e6e6e0] dark:border-[#3a3928] text-primary focus:ring-primary"/>
                                </th>
                                <th class="w-[300px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Product</th>
                                <th class="w-[200px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Category</th>
                                <th class="w-[150px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Price</th>
                                <th class="w-[120px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Status</th>
                                <th class="w-[150px] px-6 py-4 text-right text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#e6e6db] dark:divide-[#3a392a]">
                            @foreach($products as $product)
                                <tr class="group hover:bg-[#f9f506]/5 dark:hover:bg-[#f9f506]/10 transition-colors">
                                    <td class="px-6 py-4">
                                        <input type="checkbox" name="products[]" value="{{ $product->id }}" class="rounded border-[#e6e6e0] dark:border-[#3a3928] text-primary focus:ring-primary"/>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-base font-bold text-[#181811] dark:text-white">{{ $product->name }}</span>
                                            <span class="text-xs text-[#8c8b5f] dark:text-[#a1a18d] line-clamp-1">{{ Str::limit($product->details, 50) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-[#181811] dark:text-white">{{ $product->category }} / {{ $product->subcategory }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-[#181811] dark:text-white">{{ $product->price ? number_format($product->price) . ' SYP' : '—' }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold {{ $product->availabe_for_sale ? 'bg-green-500/20 text-green-700 dark:text-green-400' : 'bg-gray-500/20 text-gray-700 dark:text-gray-400' }}">
                                            {{ $product->availabe_for_sale ? 'Active' : 'Hidden' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('products.show', $product) }}" class="flex size-8 items-center justify-center rounded-full bg-[#f8f8f5] text-[#181811] hover:bg-primary transition-colors dark:bg-[#2c2b18] dark:text-white" title="View">
                                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                                            </a>
                                            <button type="button" onclick="submitDelete({{ $product->id }})" class="flex size-8 items-center justify-center rounded-full bg-[#f8f8f5] text-[#181811] hover:bg-red-100 hover:text-red-600 transition-colors dark:bg-[#2c2b18] dark:text-white" title="Delete">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>

        {{-- Pagination --}}
        @if($products->hasPages())
            <div class="flex items-center justify-between border-t border-[#e6e6db] bg-[#fcfcfb] px-6 py-4 dark:bg-[#2c2b18] dark:border-[#3a392a] rounded-b-xl">
                <span class="text-sm font-medium text-[#8c8b5f] dark:text-[#a1a18d]">Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} products</span>
                <div class="flex items-center gap-2">
                    @if ($products->onFirstPage())
                        <span class="flex size-8 items-center justify-center rounded-full border border-[#e6e6db] text-[#8c8b5f] dark:border-[#3a392a] dark:text-[#a1a18d] cursor-not-allowed">
                            <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                        </span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="flex size-8 items-center justify-center rounded-full border border-[#e6e6db] text-[#8c8b5f] hover:bg-white hover:text-[#181811] dark:border-[#3a392a] dark:text-[#a1a18d] dark:hover:bg-[#3d3c22] transition-colors">
                            <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                        </a>
                    @endif

                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if ($page == $products->currentPage())
                            <span class="flex size-8 items-center justify-center rounded-full bg-primary text-sm font-bold text-[#181811]">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="flex size-8 items-center justify-center rounded-full text-sm font-medium text-[#8c8b5f] hover:bg-[#f0f0eb] dark:text-[#a1a18d] dark:hover:bg-[#3d3c22] transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="flex size-8 items-center justify-center rounded-full border border-[#e6e6db] text-[#8c8b5f] hover:bg-white hover:text-[#181811] dark:border-[#3a392a] dark:text-[#a1a18d] dark:hover:bg-[#3d3c22] transition-colors">
                            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                        </a>
                    @else
                        <span class="flex size-8 items-center justify-center rounded-full border border-[#e6e6db] text-[#8c8b5f] dark:border-[#3a392a] dark:text-[#a1a18d] cursor-not-allowed">
                            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                        </span>
                    @endif
                </div>
            </div>
        @endif
    @endif
</div>

{{-- Hidden Delete Form --}}
<form id="deleteForm" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

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
