@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="flex flex-col gap-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div class="flex flex-col gap-1">
            <h1 class="text-4xl font-black tracking-tight text-[#181811] dark:text-white">Admin Dashboard</h1>
            <p class="text-base text-[#8c8b5f] dark:text-[#a1a18d]">Manage all products across the marketplace.</p>
        </div>
    </div>

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 md:gap-6">
        <div class="bg-white dark:bg-[#32311b] rounded-xl p-6 border border-[#e6e6db] dark:border-[#3a392a] shadow-sm hover:shadow-md transition-shadow group relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="size-12 bg-primary/20 dark:bg-primary/30 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl text-primary">people</span>
                    </div>
                </div>
                <h3 class="text-3xl md:text-4xl font-black text-[#181811] dark:text-white mb-2">{{ number_format($stats['total_users']) }}</h3>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Users</p>
            </div>
        </div>

        <div class="bg-white dark:bg-[#32311b] rounded-xl p-6 border border-[#e6e6db] dark:border-[#3a392a] shadow-sm hover:shadow-md transition-shadow group relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="size-12 bg-primary/20 dark:bg-primary/30 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl text-primary">inventory_2</span>
                    </div>
                </div>
                <h3 class="text-3xl md:text-4xl font-black text-[#181811] dark:text-white mb-2">{{ number_format($stats['total_products']) }}</h3>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Products</p>
            </div>
        </div>

        <div class="bg-white dark:bg-[#32311b] rounded-xl p-6 border border-[#e6e6db] dark:border-[#3a392a] shadow-sm hover:shadow-md transition-shadow group relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="size-12 bg-primary/20 dark:bg-primary/30 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl text-primary">visibility</span>
                    </div>
                </div>
                <h3 class="text-3xl md:text-4xl font-black text-[#181811] dark:text-white mb-2">{{ number_format($stats['total_hits']) }}</h3>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Total Hits</p>
            </div>
        </div>

        <div class="bg-white dark:bg-[#32311b] rounded-xl p-6 border border-[#e6e6db] dark:border-[#3a392a] shadow-sm hover:shadow-md transition-shadow group relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="size-12 bg-primary/20 dark:bg-primary/30 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl text-primary">person_add</span>
                    </div>
                </div>
                <h3 class="text-3xl md:text-4xl font-black text-[#181811] dark:text-white mb-2">{{ number_format($stats['new_users_last_month']) }}</h3>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">New Users (Last Month)</p>
            </div>
        </div>

        <div class="bg-white dark:bg-[#32311b] rounded-xl p-6 border border-[#e6e6db] dark:border-[#3a392a] shadow-sm hover:shadow-md transition-shadow group relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/10 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-500"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-4">
                    <div class="size-12 bg-primary/20 dark:bg-primary/30 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl text-primary">add_shopping_cart</span>
                    </div>
                </div>
                <h3 class="text-3xl md:text-4xl font-black text-[#181811] dark:text-white mb-2">{{ number_format($stats['new_products_last_month']) }}</h3>
                <p class="text-sm font-medium text-gray-600 dark:text-gray-300">New Products (Last Month)</p>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <form method="GET" action="{{ route('admin.dashboard') }}" class="flex flex-col gap-4 rounded-3xl bg-white p-4 shadow-sm dark:bg-[#32311b] md:flex-row md:items-center border border-[#e6e6db] dark:border-[#3a392a]">
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-4 flex items-center text-[#8c8b5f]">
                <span class="material-symbols-outlined">search</span>
            </span>
            <input 
                class="h-12 w-full rounded-xl border border-[#e6e6db] bg-[#f8f8f5] pl-12 pr-4 text-base font-medium text-[#181811] placeholder-[#8c8b5f] focus:border-primary focus:ring-0 dark:bg-background-dark dark:border-[#3a392a] dark:text-white" 
                placeholder="Search products..."
                name="q"
                value="{{ request('q') }}"
            />
        </div>
        <select name="category" class="h-12 rounded-xl border border-[#e6e6db] bg-[#f8f8f5] px-4 text-base font-medium text-[#181811] focus:border-primary focus:ring-0 dark:bg-background-dark dark:border-[#3a392a] dark:text-white">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
            @endforeach
        </select>
        <select name="subcategory" class="h-12 rounded-xl border border-[#e6e6db] bg-[#f8f8f5] px-4 text-base font-medium text-[#181811] focus:border-primary focus:ring-0 dark:bg-background-dark dark:border-[#3a392a] dark:text-white">
            <option value="">All Subcategories</option>
            @foreach($subcategories as $subcategory)
                <option value="{{ $subcategory }}" {{ request('subcategory') == $subcategory ? 'selected' : '' }}>{{ $subcategory }}</option>
            @endforeach
        </select>
        <button type="submit" class="h-12 px-6 rounded-xl bg-primary hover:bg-[#d9d505] text-[#181811] font-bold transition-colors shadow-lg shadow-primary/20 flex items-center justify-center gap-2">
            <span class="material-symbols-outlined">filter_list</span>
            <span>Filter</span>
        </button>
    </form>

    {{-- Products Grid --}}
    @if($products->isEmpty())
        <div class="text-center py-12 rounded-3xl bg-white dark:bg-[#32311b] border border-[#e6e6db] dark:border-[#3a392a]">
            <p class="text-gray-500 dark:text-gray-400 text-lg">No products found.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white dark:bg-[#32311b] rounded-xl overflow-hidden border border-[#e6e6db] dark:border-[#3a392a] shadow-sm hover:shadow-md transition-shadow group">
                    {{-- Image --}}
                    <a href="{{ route('products.show', $product) }}" class="block">
                        @if($product->image)
                            <div class="relative aspect-video overflow-hidden bg-gray-100 dark:bg-gray-800 cursor-pointer">
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"/>
                            </div>
                        @else
                            <div class="aspect-video bg-gray-100 dark:bg-gray-800 flex items-center justify-center cursor-pointer">
                                <span class="material-symbols-outlined text-gray-400 text-4xl">image</span>
                            </div>
                        @endif
                    </a>

                    <div class="p-5 space-y-3">
                        <a href="{{ route('products.show', $product) }}" class="block">
                            <h3 class="text-lg font-bold text-[#181811] dark:text-white line-clamp-2 hover:text-primary transition-colors cursor-pointer">{{ $product->name }}</h3>
                        </a>
                        
                        <div class="flex items-center gap-2 text-sm text-[#8c8b5f]">
                            <span class="material-symbols-outlined text-base">storefront</span>
                            <span class="font-medium">{{ $product->user->store_name }}</span>
                        </div>

                        <div class="flex items-center gap-2 text-sm text-[#8c8b5f]">
                            <span class="material-symbols-outlined text-base">person</span>
                            <a href="{{ route('admin.users.show', $product->user) }}" class="font-medium hover:text-primary transition-colors">
                                {{ $product->user->first_name }} {{ $product->user->last_name }}
                            </a>
                        </div>

                        <div class="flex items-center justify-between pt-2 border-t border-[#e6e6db] dark:border-[#3a392a]">
                            <div class="flex items-center gap-2 text-sm text-[#8c8b5f]">
                                <span class="material-symbols-outlined text-base">visibility</span>
                                <span class="font-medium">{{ number_format($product->hits) }} hits</span>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $product->availabe_for_sale ? 'bg-green-500/20 text-green-700 dark:text-green-400' : 'bg-red-500/20 text-red-700 dark:text-red-400' }}">
                                {{ $product->availabe_for_sale ? 'Available' : 'Not Available' }}
                            </span>
                        </div>
                    </div>

                    <div class="p-5 pt-0 flex gap-2 border-t border-[#e6e6db] dark:border-[#3a392a]">
                        <form action="{{ route('admin.products.toggle', $product) }}" method="POST" class="flex-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full h-10 px-4 rounded-xl {{ $product->availabe_for_sale ? 'bg-green-500/20 hover:bg-green-500/30 text-green-700 dark:text-green-400' : 'bg-red-500/20 hover:bg-red-500/30 text-red-700 dark:text-red-400' }} font-bold text-sm transition-colors flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-lg">{{ $product->availabe_for_sale ? 'toggle_on' : 'toggle_off' }}</span>
                                <span>{{ $product->availabe_for_sale ? 'Disable' : 'Enable' }}</span>
                            </button>
                        </form>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full h-10 px-4 rounded-xl bg-red-500/20 hover:bg-red-500/30 text-red-600 dark:text-red-400 font-bold text-sm transition-colors flex items-center justify-center gap-2">
                                <span class="material-symbols-outlined text-lg">delete</span>
                                <span>Delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

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
@endsection
