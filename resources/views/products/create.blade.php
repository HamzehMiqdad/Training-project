<!DOCTYPE html>
<html class="light" lang="{{ app()->getLocale() }}">
<head>
    @include('partials.head-assets')
    <title>{{ __('messages.list_new_item') }} - {{ __('messages.marketplace') }}</title>
    <style type="text/tailwindcss">
        body {
            font-family: "Spline Sans", sans-serif;
        }
        .filter-checkbox {
            @apply rounded border-[#e6e6e0] dark:border-[#3a3928] text-primary focus:ring-primary;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark min-h-screen flex flex-col font-display text-slate-900 dark:text-white selection:bg-primary selection:text-black">
    
    @include('partials.header')

    <main class="flex-1 flex flex-col items-center py-8 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-[960px] flex flex-col gap-8">
            <div class="flex flex-wrap justify-between items-end gap-3 px-2">
                <div class="flex min-w-72 flex-col gap-2">
                    <p class="text-slate-900 dark:text-white text-3xl sm:text-4xl font-black leading-tight tracking-[-0.033em]">{{ __('messages.list_new_item') }}</p>
                    <p class="text-stone-500 dark:text-stone-400 text-base font-normal leading-normal">{{ __('messages.reach_thousands_buyers') }}</p>
                </div>
            </div>

            {{-- Display Validation Errors --}}
            @if ($errors->any())
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
                    <ul class="mb-0 text-sm text-red-600 dark:text-red-400 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
                @csrf

                {{-- Product Media Section --}}
                <section class="bg-white dark:bg-stone-dark rounded-lg p-6 sm:p-8 shadow-sm border border-stone-100 dark:border-stone-800">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-symbols-outlined text-primary">image</span>
                        <h3 class="text-slate-900 dark:text-white text-xl font-bold leading-tight tracking-[-0.015em]">{{ __('messages.product_media') }}</h3>
                    </div>
                    <div class="flex flex-col gap-4">
                        <div class="relative group cursor-pointer flex flex-col items-center justify-center w-full h-64 rounded-xl border-2 border-dashed border-stone-300 dark:border-stone-700 bg-stone-50 dark:bg-stone-800/50 hover:bg-stone-100 dark:hover:bg-stone-800 hover:border-primary transition-all">
                            <input 
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10 @error('image') border-red-500 @enderror" 
                                type="file" 
                                name="image" 
                                id="imageInput"
                                accept="image/*"
                                onchange="handleImagePreview(this)"
                                required
                            />
                            <div class="flex flex-col items-center gap-3 text-stone-500 dark:text-stone-400">
                                <div class="p-3 bg-white dark:bg-stone-800 rounded-full shadow-sm group-hover:scale-110 transition-transform duration-300">
                                    <span class="material-symbols-outlined text-3xl text-primary">add_a_photo</span>
                                </div>
                                <p class="text-base font-medium"><span class="text-slate-900 dark:text-white underline decoration-primary decoration-2 underline-offset-2">{{ __('messages.click_to_upload') }}</span> {{ __('messages.drag_and_drop') }}</p>
                                <p class="text-sm">{{ __('messages.image_formats') }}</p>
                            </div>
                        </div>
                        @error('image')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <div id="imagePreview" class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-3 mt-2 hidden">
                            <div class="relative aspect-square rounded-xl overflow-hidden group">
                                <img id="previewImage" class="w-full h-full object-cover bg-center bg-cover bg-no-repeat" src="" alt="Product preview"/>
                                <button type="button" onclick="removeImagePreview()" class="absolute top-1 right-1 size-6 bg-black/50 text-white rounded-full flex items-center justify-center hover:bg-red-500 transition-colors">
                                    <span class="material-symbols-outlined text-sm">close</span>
                                </button>
                                <div class="absolute bottom-0 inset-x-0 bg-black/60 text-white text-[10px] font-bold px-2 py-1 text-center">{{ __('messages.cover') }}</div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Listing Details Section --}}
                <section class="bg-white dark:bg-stone-dark rounded-lg p-6 sm:p-8 shadow-sm border border-stone-100 dark:border-stone-800">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-primary">edit_note</span>
                        <h3 class="text-slate-900 dark:text-white text-xl font-bold leading-tight tracking-[-0.015em]">{{ __('messages.listing_details') }}</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <input name="hits" type="hidden" value="0"/>
                        
                        <div class="col-span-1 md:col-span-2">
                            <label class="flex flex-col gap-2">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.product_name') }}</p>
                                <input 
                                    class="form-input w-full rounded-xl border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 placeholder:text-stone-400 dark:placeholder:text-stone-600 font-normal shadow-sm @error('name') border-red-500 @enderror" 
                                    name="name" 
                                    id="name"
                                    placeholder="{{ __('messages.enter_descriptive_title') }}" 
                                    type="text"
                                    value="{{ old('name') }}"
                                    required
                                />
                                @error('name')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="flex flex-col gap-2">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.details_description') }}</p>
                                <textarea 
                                    class="form-textarea w-full rounded-xl border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary min-h-[140px] p-4 placeholder:text-stone-400 dark:placeholder:text-stone-600 font-normal shadow-sm resize-y @error('details') border-red-500 @enderror" 
                                    name="details" 
                                    placeholder="{{ __('messages.tell_about_store') }}"
                                    required
                                >{{ old('details') }}</textarea>
                                @error('details')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="col-span-1">
                            <label class="flex flex-col gap-2">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.categories') }}</p>
                                <div class="relative">
                                    <input 
                                        type="text" 
                                        name="category" 
                                        id="category"
                                        class="form-input w-full rounded-xl border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 placeholder:text-stone-400 dark:placeholder:text-stone-600 font-normal shadow-sm @error('category') border-red-500 @enderror" 
                                        placeholder="{{ __('messages.enter_category') }}"
                                        value="{{ old('category') }}"
                                        required
                                    />
                                </div>
                                @error('category')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="col-span-1">
                            <label class="flex flex-col gap-2">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.subcategories') }}</p>
                                <div class="relative">
                                    <input 
                                        type="text" 
                                        name="subcategory" 
                                        id="subcategory"
                                        class="form-input w-full rounded-xl border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 placeholder:text-stone-400 dark:placeholder:text-stone-600 font-normal shadow-sm @error('subcategory') border-red-500 @enderror" 
                                        placeholder="{{ __('messages.enter_subcategory') }}"
                                        value="{{ old('subcategory') }}"
                                    />
                                </div>
                                @error('subcategory')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="col-span-1">
                            <label class="flex flex-col gap-2">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.product_code_sku') }}</p>
                                <input 
                                    class="form-input w-full rounded-xl border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 placeholder:text-stone-400 font-normal shadow-sm @error('code') border-red-500 @enderror" 
                                    name="code" 
                                    placeholder="{{ __('messages.sku_placeholder') }}" 
                                    type="text"
                                    value="{{ old('code') }}"
                                />
                                @error('code')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="col-span-1">
                            <label class="flex flex-col gap-2">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.price') }}</p>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-stone-500 font-medium">SYP</span>
                                    <input 
                                        class="form-input w-full rounded-xl border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 pl-12 pr-4 placeholder:text-stone-400 font-normal shadow-sm @error('price') border-red-500 @enderror" 
                                        name="price" 
                                        placeholder="0" 
                                        step="1" 
                                        type="number"
                                        value="{{ old('price') }}"
                                    />
                                </div>
                                @error('price')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="col-span-1 md:col-span-2 flex items-center justify-between p-4 bg-stone-50 dark:bg-stone-800/50 rounded-xl border border-stone-200 dark:border-stone-700 mt-2">
                            <div class="flex flex-col gap-1">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-semibold">{{ __('messages.available_for_sale') }}</p>
                                <p class="text-sm text-stone-500">{{ __('messages.enable_visible') }}</p>
                            </div>
                            <label class="inline-flex items-center cursor-pointer">
                                <input 
                                    class="sr-only peer" 
                                    name="availabe_for_sale" 
                                    type="checkbox"
                                    {{ old('availabe_for_sale', true) ? 'checked' : '' }}
                                />
                                <div class="relative w-14 h-7 bg-stone-200 peer-focus:outline-none rounded-full peer dark:bg-stone-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                            </label>
                        </div>
                    </div>
                </section>

                <div class="flex flex-col-reverse sm:flex-row justify-end items-center gap-4 pt-6 pb-20">
                    <a href="{{ route('dashboard') }}" class="w-full sm:w-auto flex min-w-[120px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-12 px-6 bg-transparent border border-stone-300 dark:border-stone-700 text-stone-600 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800 text-base font-bold transition-all">
                        {{ __('messages.cancel') }}
                    </a>
                    <button class="w-full sm:w-auto flex min-w-[200px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-12 px-8 bg-primary text-[#181811] hover:bg-[#eae605] text-base font-bold shadow-lg shadow-primary/20 transition-all hover:scale-[1.02] active:scale-95" type="submit">
                        {{ __('messages.publish_product') }}
                    </button>
                </div>
            </form>
        </div>
    </main>

    @include('partials.footer')

    {{-- Awesomplete for live combobox --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.5/awesomplete.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/awesomplete/1.1.5/awesomplete.min.js"></script>

    <script>
        function setupCombobox(fieldId) {
            const input = document.getElementById(fieldId);
            if (!input) return;
            const awesomplete = new Awesomplete(input, { minChars: 1, maxItems: 10 });
            input.addEventListener('input', function() {
                fetch(`/products/suggestions/${fieldId}?q=${input.value}`)
                    .then(res => res.json())
                    .then(data => {
                        awesomplete.list = data;
                    });
            });
        }

        function handleImagePreview(input) {
            const preview = document.getElementById('imagePreview');
            const previewImage = document.getElementById('previewImage');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImagePreview() {
            const input = document.getElementById('imageInput');
            const preview = document.getElementById('imagePreview');
            input.value = '';
            preview.classList.add('hidden');
        }

        // Initialize comboboxes
        setupCombobox('category');
        setupCombobox('subcategory');
    </script>
</body>
</html>
