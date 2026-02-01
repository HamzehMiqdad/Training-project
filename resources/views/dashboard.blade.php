<!DOCTYPE html>
<html class="light" lang="{{ app()->getLocale() }}">
<head>
    @include('partials.head-assets')
    <title>{{ __('messages.product_management') }} - {{ __('messages.marketplace') }}</title>
    <style type="text/tailwindcss">
        .toggle-checkbox:checked {
            @apply right-0 border-primary bg-primary;
        }
        .toggle-checkbox:checked + .toggle-label {
            @apply bg-primary/20;
        }
        body {
            font-family: "Spline Sans", sans-serif;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-[#181811] dark:text-white">

    @include('partials.header')

    <main class="flex-1 px-4 py-8 md:px-8 lg:px-20 xl:px-40">
        <div class="mx-auto flex w-full max-w-7xl flex-col gap-8">
            {{-- Success Message --}}
            @if(session('success'))
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4">
                    <p class="text-sm text-green-600 dark:text-green-400">{{ session('success') }}</p>
                </div>
            @endif

            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div class="flex flex-col gap-1">
                    <h1 class="text-4xl font-black tracking-tight text-[#181811] dark:text-white">{{ __('messages.product_management') }}</h1>
                    <p class="text-base text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.track_performance') }}</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('products.create') }}" class="flex h-12 items-center justify-center gap-2 rounded-full bg-primary px-6 text-sm font-bold text-[#181811] shadow-lg shadow-primary/20 hover:brightness-105 transition-all">
                        <span class="material-symbols-outlined text-[20px]">add</span>
                        <span>{{ __('messages.new_product') }}</span>
                    </a>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="flex flex-col gap-2 rounded-3xl bg-white p-6 shadow-sm dark:bg-[#32311b] border border-[#e6e6db] dark:border-[#3a392a]">
                    <div class="flex items-center gap-3">
                        <div class="flex size-10 items-center justify-center rounded-xl bg-[#fcfcfb] text-[#8c8b5f] dark:bg-[#2c2b18]">
                            <span class="material-symbols-outlined">inventory</span>
                        </div>
                        <span class="text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.total_products') }}</span>
                    </div>
                    <div class="mt-2">
                        <span class="text-3xl font-black text-[#181811] dark:text-white">{{ $products->count() }}</span>
                    </div>
                </div>

                <div class="flex flex-col gap-2 rounded-3xl bg-white p-6 shadow-sm dark:bg-[#32311b] border border-[#e6e6db] dark:border-[#3a392a]">
                    <div class="flex items-center gap-3">
                        <div class="flex size-10 items-center justify-center rounded-xl bg-[#fcfcfb] text-[#8c8b5f] dark:bg-[#2c2b18]">
                            <span class="material-symbols-outlined">visibility</span>
                        </div>
                        <span class="text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.total_hits') }}</span>
                    </div>
                    <div class="mt-2">
                        <span class="text-3xl font-black text-[#181811] dark:text-white">{{ number_format($totalHits ?? 0) }}</span>
                    </div>
                </div>

                <div class="flex flex-col gap-2 rounded-3xl bg-white p-6 shadow-sm dark:bg-[#32311b] border border-[#e6e6db] dark:border-[#3a392a]">
                    <div class="flex items-center gap-3">
                        <div class="flex size-10 items-center justify-center rounded-xl bg-primary/20 text-[#181811] dark:text-primary">
                            <span class="material-symbols-outlined">trending_up</span>
                        </div>
                        <span class="text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.top_product') }}</span>
                    </div>
                    <div class="mt-2">
                        <div class="text-lg font-bold text-[#181811] dark:text-white truncate">
                            {{ $topProduct?->name ?? '—' }}
                        </div>
                        <span class="text-sm text-[#8c8b5f] font-medium">
                            {{ number_format($topProduct?->hits ?? 0) }} {{ __('messages.hits') }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Search and Filter Bar --}}
            <form method="GET" action="{{ route('dashboard') }}" class="flex flex-col gap-4 rounded-3xl bg-white p-4 shadow-sm dark:bg-[#32311b] md:flex-row md:items-center border border-[#e6e6db] dark:border-[#3a392a]">
                <div class="relative flex-1">
                    <span class="absolute inset-y-0 left-4 flex items-center text-[#8c8b5f]">
                        <span class="material-symbols-outlined">search</span>
                    </span>
                    <input 
                        class="h-12 w-full rounded-xl border border-[#e6e6db] bg-[#f8f8f5] pl-12 pr-4 text-base font-medium text-[#181811] placeholder-[#8c8b5f] focus:border-primary focus:ring-0 dark:bg-background-dark dark:border-[#3a392a] dark:text-white" 
                        placeholder="{{ __('messages.search_by_name_code') }}" 
                        name="q"
                        value="{{ $search }}"
                    />
                </div>
                <button type="submit" class="flex h-12 items-center justify-center gap-2 rounded-xl border border-[#e6e6db] bg-white dark:bg-[#32311b] dark:border-[#3a392a] px-4 text-sm font-bold text-[#181811] dark:text-white hover:bg-[#f0f0eb] transition-colors">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                    <span>{{ __('messages.search') }}</span>
                </button>
            </form>

            {{-- Products Table --}}
            <div class="overflow-hidden rounded-[2rem] border border-[#e6e6db] bg-white shadow-sm dark:bg-[#32311b] dark:border-[#3a392a]">
                @if($products->isEmpty())
                    <div class="p-12 text-center">
                        <p class="text-[#8c8b5f] dark:text-[#a1a18d] text-lg mb-4">{{ __('messages.no_products_yet') }}</p>
                        <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 rounded-full bg-primary px-6 py-3 text-sm font-bold text-[#181811] shadow-lg shadow-primary/20 hover:brightness-105 transition-all">
                            <span class="material-symbols-outlined">add</span>
                            <span>{{ __('messages.create_first_product') }}</span>
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[1000px] table-fixed">
                            <thead>
                                <tr class="border-b border-[#e6e6db] bg-[#fcfcfb] dark:bg-[#2c2b18] dark:border-[#3a392a]">
                                    <th class="w-[300px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.name_code') }}</th>
                                    <th class="w-[120px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.price') }}</th>
                                    <th class="w-[200px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.category_sub') }}</th>
                                    <th class="w-[120px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.total_hits') }}</th>
                                    <th class="w-[160px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.available_for_sale') }}</th>
                                    <th class="w-[100px] px-6 py-4 text-right text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#e6e6db] dark:divide-[#3a392a]">
                                @foreach($products as $product)
                                    <tr class="group hover:bg-[#f9f506]/5 dark:hover:bg-[#f9f506]/10 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <div class="size-12 rounded-xl bg-cover bg-center bg-no-repeat bg-[#f0f0eb] shrink-0">
                                                    @if($product->image)
                                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="size-12 rounded-xl object-cover"/>
                                                    @else
                                                        <div class="size-12 rounded-xl bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                                            <span class="material-symbols-outlined text-gray-400">image</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex flex-col min-w-0">
                                                    <a href="{{ route('products.show', $product) }}" class="text-base font-bold text-[#181811] dark:text-white hover:text-primary transition-colors truncate">
                                                        {{ $product->name }}
                                                    </a>
                                                    @if($product->code)
                                                        <span class="text-xs font-medium text-[#8c8b5f]">{{ __('messages.code') }} {{ $product->code }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 font-mono text-sm font-medium text-[#181811] dark:text-white">
                                            @if($product->price)
                                                {{ number_format($product->price) }} SYP
                                            @else
                                                <span class="text-[#8c8b5f]">—</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col">
                                                <span class="text-sm font-bold text-[#181811] dark:text-white">{{ $product->category }}</span>
                                                @if($product->subcategory)
                                                    <span class="text-xs text-[#8c8b5f]">{{ $product->subcategory }}</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm font-bold text-[#181811] dark:text-white">{{ number_format($product->hits ?? 0) }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('products.update', $product) }}" method="POST" class="inline" id="toggle-form-{{ $product->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="name" value="{{ $product->name }}">
                                                <input type="hidden" name="details" value="{{ $product->details }}">
                                                <input type="hidden" name="category" value="{{ $product->category }}">
                                                <input type="hidden" name="subcategory" value="{{ $product->subcategory ?? '' }}">
                                                <input type="hidden" name="code" value="{{ $product->code ?? '' }}">
                                                <input type="hidden" name="price" value="{{ $product->price ?? '' }}">
                                                <input type="hidden" name="availabe_for_sale" id="availability-{{ $product->id }}" value="{{ $product->availabe_for_sale ? '1' : '0' }}">
                                                <div class="relative inline-block w-10 align-middle select-none">
                                                    <input 
                                                        type="checkbox" 
                                                        class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer transition-all duration-300 {{ $product->availabe_for_sale ? 'right-0 border-primary bg-primary' : 'left-0 border-[#e6e6db] bg-white' }}" 
                                                        {{ $product->availabe_for_sale ? 'checked' : '' }}
                                                        onchange="document.getElementById('availability-{{ $product->id }}').value = this.checked ? '1' : '0'; this.form.submit();"
                                                    />
                                                    <label class="toggle-label block overflow-hidden h-6 rounded-full {{ $product->availabe_for_sale ? 'bg-primary/20' : 'bg-[#f8f8f5] dark:bg-[#2c2b18]' }} cursor-pointer"></label>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('products.edit', $product) }}" class="flex size-8 items-center justify-center rounded-full bg-[#f8f8f5] text-[#181811] hover:bg-primary transition-colors dark:bg-[#2c2b18] dark:text-white" title="{{ __('messages.edit') }}">
                                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                                </a>
                                                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('{{ __('messages.confirm_delete') }}');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="flex size-8 items-center justify-center rounded-full bg-[#f8f8f5] text-[#181811] hover:bg-red-100 hover:text-red-600 transition-colors dark:bg-[#2c2b18] dark:text-white" title="{{ __('messages.delete') }}">
                                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </main>

    @include('partials.footer')

</body>
</html>
