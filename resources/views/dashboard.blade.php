<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Product Management - MarketHub</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#f9f506",
                        "background-light": "#f8f8f5",
                        "background-dark": "#23220f",
                    },
                    fontFamily: {
                        "display": ["Spline Sans", "sans-serif"],
                        "sans": ["Spline Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "1rem", 
                        "lg": "2rem", 
                        "xl": "3rem", 
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
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
                    <h1 class="text-4xl font-black tracking-tight text-[#181811] dark:text-white">Product Management</h1>
                    <p class="text-base text-[#8c8b5f] dark:text-[#a1a18d]">Track performance and manage your global product catalog.</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('products.create') }}" class="flex h-12 items-center justify-center gap-2 rounded-full bg-primary px-6 text-sm font-bold text-[#181811] shadow-lg shadow-primary/20 hover:brightness-105 transition-all">
                        <span class="material-symbols-outlined text-[20px]">add</span>
                        <span>New Product</span>
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
                        <span class="text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Total Products</span>
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
                        <span class="text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Total Hits</span>
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
                        <span class="text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Top Product</span>
                    </div>
                    <div class="mt-2">
                        <div class="text-lg font-bold text-[#181811] dark:text-white truncate">
                            {{ $topProduct?->name ?? '—' }}
                        </div>
                        <span class="text-sm text-[#8c8b5f] font-medium">
                            {{ number_format($topProduct?->hits ?? 0) }} hits
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
                        placeholder="Search by name, code..." 
                        name="q"
                        value="{{ $search }}"
                    />
                </div>
                <button type="submit" class="flex h-12 items-center justify-center gap-2 rounded-xl border border-[#e6e6db] bg-white dark:bg-[#32311b] dark:border-[#3a392a] px-4 text-sm font-bold text-[#181811] dark:text-white hover:bg-[#f0f0eb] transition-colors">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                    <span>Search</span>
                </button>
            </form>

            {{-- Products Table --}}
            <div class="overflow-hidden rounded-[2rem] border border-[#e6e6db] bg-white shadow-sm dark:bg-[#32311b] dark:border-[#3a392a]">
                @if($products->isEmpty())
                    <div class="p-12 text-center">
                        <p class="text-[#8c8b5f] dark:text-[#a1a18d] text-lg mb-4">You have no products yet.</p>
                        <a href="{{ route('products.create') }}" class="inline-flex items-center gap-2 rounded-full bg-primary px-6 py-3 text-sm font-bold text-[#181811] shadow-lg shadow-primary/20 hover:brightness-105 transition-all">
                            <span class="material-symbols-outlined">add</span>
                            <span>Create Your First Product</span>
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-[1000px] table-fixed">
                            <thead>
                                <tr class="border-b border-[#e6e6db] bg-[#fcfcfb] dark:bg-[#2c2b18] dark:border-[#3a392a]">
                                    <th class="w-[300px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Name/Code</th>
                                    <th class="w-[120px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Price</th>
                                    <th class="w-[200px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Category/Sub</th>
                                    <th class="w-[120px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Hits</th>
                                    <th class="w-[160px] px-6 py-4 text-left text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Available for Sale</th>
                                    <th class="w-[100px] px-6 py-4 text-right text-sm font-bold text-[#8c8b5f] dark:text-[#a1a18d]">Actions</th>
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
                                                        <span class="text-xs font-medium text-[#8c8b5f]">CODE: {{ $product->code }}</span>
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
                                                <a href="{{ route('products.edit', $product) }}" class="flex size-8 items-center justify-center rounded-full bg-[#f8f8f5] text-[#181811] hover:bg-primary transition-colors dark:bg-[#2c2b18] dark:text-white" title="Edit">
                                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                                </a>
                                                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="flex size-8 items-center justify-center rounded-full bg-[#f8f8f5] text-[#181811] hover:bg-red-100 hover:text-red-600 transition-colors dark:bg-[#2c2b18] dark:text-white" title="Delete">
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
