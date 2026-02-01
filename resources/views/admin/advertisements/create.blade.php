@extends('admin.layouts.app')

@section('title', __('messages.add_advertisement'))

@section('content')
<div class="flex flex-col gap-8">
    <div class="flex flex-col gap-1">
        <h1 class="text-4xl font-black tracking-tight text-[#181811] dark:text-white">{{ __('messages.add_advertisement') }}</h1>
        <p class="text-base text-[#8c8b5f] dark:text-[#a1a18d]">{{ __('messages.create_new_ad') }}</p>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-4">
            <ul class="mb-0 text-sm text-red-600 dark:text-red-400 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.advertisements.store') }}" class="flex flex-col gap-6">
        @csrf

        <section class="bg-white dark:bg-[#32311b] rounded-xl p-6 sm:p-8 shadow-sm border border-[#e6e6db] dark:border-[#3a392a]">
            <div class="flex items-center gap-2 mb-6">
                <span class="material-symbols-outlined text-primary">campaign</span>
                <h3 class="text-slate-900 dark:text-white text-xl font-bold leading-tight tracking-[-0.015em]">{{ __('messages.ad_details') }}</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-1 md:col-span-2">
                    <label class="flex flex-col gap-2">
                        <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.owner') }}</p>
                        <input 
                            class="form-input w-full rounded-xl border-[#e6e6db] dark:border-[#3a392a] bg-white dark:bg-[#2c2b18] text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 placeholder:text-stone-400 dark:placeholder:text-stone-600 font-normal shadow-sm @error('owner') border-red-500 @enderror" 
                            name="owner" 
                            type="text"
                            value="{{ old('owner') }}"
                            required
                        />
                        @error('owner')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </label>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="flex flex-col gap-2">
                        <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.link') }}</p>
                        <input 
                            class="form-input w-full rounded-xl border-[#e6e6db] dark:border-[#3a392a] bg-white dark:bg-[#2c2b18] text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 placeholder:text-stone-400 dark:placeholder:text-stone-600 font-normal shadow-sm @error('link') border-red-500 @enderror" 
                            name="link" 
                            type="url"
                            placeholder="https://example.com"
                            value="{{ old('link') }}"
                            required
                        />
                        @error('link')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </label>
                </div>

                <div class="col-span-1">
                    <label class="flex flex-col gap-2">
                        <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.place') }}</p>
                        <select name="place" class="w-full rounded-xl border-[#e6e6db] dark:border-[#3a392a] bg-white dark:bg-[#2c2b18] text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 font-normal shadow-sm @error('place') border-red-500 @enderror" required>
                            <option value="products_top" {{ old('place') === 'products_top' ? 'selected' : '' }}>Products Top</option>
                            <option value="products_sidebar" {{ old('place') === 'products_sidebar' ? 'selected' : '' }}>Products Sidebar</option>
                            <option value="products_bottom" {{ old('place') === 'products_bottom' ? 'selected' : '' }}>Products Bottom</option>
                        </select>
                        @error('place')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </label>
                </div>

                <div class="col-span-1">
                    <label class="flex flex-col gap-2">
                        <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.image') }}</p>
                        <input 
                            class="form-input w-full rounded-xl border-[#e6e6db] dark:border-[#3a392a] bg-white dark:bg-[#2c2b18] text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-[#181811] hover:file:bg-[#d9d505] @error('image') border-red-500 @enderror" 
                            type="file" 
                            name="image" 
                            accept="image/*"
                            required
                        />
                        @error('image')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </label>
                </div>

                <div class="col-span-1">
                    <label class="flex flex-col gap-2">
                        <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.start_date') }}</p>
                        <input 
                            class="form-input w-full rounded-xl border-[#e6e6db] dark:border-[#3a392a] bg-white dark:bg-[#2c2b18] text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 font-normal shadow-sm @error('start_time') border-red-500 @enderror" 
                            type="date" 
                            name="start_time" 
                            value="{{ old('start_time') }}"
                            required
                        />
                        @error('start_time')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </label>
                </div>

                <div class="col-span-1">
                    <label class="flex flex-col gap-2">
                        <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.end_date') }}</p>
                        <input 
                            class="form-input w-full rounded-xl border-[#e6e6db] dark:border-[#3a392a] bg-white dark:bg-[#2c2b18] text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 font-normal shadow-sm @error('end_time') border-red-500 @enderror" 
                            type="date" 
                            name="end_time" 
                            value="{{ old('end_time') }}"
                            required
                        />
                        @error('end_time')
                            <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </label>
                </div>
            </div>
        </section>

        <div class="flex flex-col-reverse sm:flex-row justify-end items-center gap-4 pt-6">
            <a href="{{ route('admin.advertisements.index') }}" class="w-full sm:w-auto flex min-w-[120px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-12 px-6 bg-transparent border border-[#e6e6db] dark:border-[#3a392a] text-[#181811] dark:text-white hover:bg-[#f8f8f5] dark:hover:bg-[#2c2b18] text-base font-bold transition-all">
                {{ __('messages.cancel') }}
            </a>
            <button class="w-full sm:w-auto flex min-w-[200px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-12 px-8 bg-primary text-[#181811] hover:bg-[#eae605] text-base font-bold shadow-lg shadow-primary/20 transition-all hover:scale-[1.02] active:scale-95" type="submit">
                {{ __('messages.create_ad') }}
            </button>
        </div>
    </form>
</div>
@endsection
