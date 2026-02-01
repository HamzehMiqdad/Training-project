<!DOCTYPE html>
<html class="light" lang="{{ app()->getLocale() }}">
<head>
    @include('partials.head-assets')
    <title>{{ __('messages.edit_profile') }} - {{ __('messages.marketplace') }}</title>
    <style type="text/tailwindcss">
        body {
            font-family: "Spline Sans", sans-serif;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-[#181811] dark:text-white min-h-screen flex flex-col font-display">

    @include('partials.header')

    <main class="flex-1 flex flex-col items-center py-8 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-[960px] flex flex-col gap-8">
            <div class="flex flex-wrap justify-between items-end gap-3 px-2">
                <div class="flex min-w-72 flex-col gap-2">
                    <p class="text-slate-900 dark:text-white text-3xl sm:text-4xl font-black leading-tight tracking-[-0.033em]">{{ __('messages.edit_profile') }}</p>
                    <p class="text-stone-500 dark:text-stone-400 text-base font-normal leading-normal">{{ __('messages.update_profile_info') }}</p>
                </div>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4">
                    <p class="text-sm text-green-600 dark:text-green-400">{{ session('success') }}</p>
                </div>
            @endif

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

            {{-- Profile Information Section --}}
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-6">
                @csrf
                @method('PATCH')

                <section class="bg-white dark:bg-stone-dark rounded-lg p-6 sm:p-8 shadow-sm border border-stone-100 dark:border-stone-800">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-primary">person</span>
                        <h3 class="text-slate-900 dark:text-white text-xl font-bold leading-tight tracking-[-0.015em]">{{ __('messages.profile_information') }}</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1 md:col-span-2">
                            <label class="flex flex-col gap-2">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.email') }}</p>
                                <input 
                                    class="form-input w-full rounded-xl border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 placeholder:text-stone-400 dark:placeholder:text-stone-600 font-normal shadow-sm @error('email') border-red-500 @enderror" 
                                    name="email" 
                                    type="email"
                                    value="{{ old('email', $user->email) }}"
                                    disabled
                                    readonly
                                />
                                <p class="text-xs text-stone-500">{{ __('messages.email_cannot_change') }}</p>
                            </label>
                        </div>

                        <div class="col-span-1">
                            <label class="flex flex-col gap-2">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.first_name') }}</p>
                                <input 
                                    class="form-input w-full rounded-xl border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 placeholder:text-stone-400 dark:placeholder:text-stone-600 font-normal shadow-sm @error('first_name') border-red-500 @enderror" 
                                    name="first_name" 
                                    placeholder="{{ __('messages.first_name') }}" 
                                    type="text"
                                    value="{{ old('first_name', $user->first_name) }}"
                                    required
                                />
                                @error('first_name')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="col-span-1">
                            <label class="flex flex-col gap-2">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.last_name') }}</p>
                                <input 
                                    class="form-input w-full rounded-xl border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 placeholder:text-stone-400 dark:placeholder:text-stone-600 font-normal shadow-sm @error('last_name') border-red-500 @enderror" 
                                    name="last_name" 
                                    placeholder="{{ __('messages.last_name') }}" 
                                    type="text"
                                    value="{{ old('last_name', $user->last_name) }}"
                                    required
                                />
                                @error('last_name')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="col-span-1">
                            <label class="flex flex-col gap-2">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.phone_number') }}</p>
                                <input 
                                    class="form-input w-full rounded-xl border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 placeholder:text-stone-400 dark:placeholder:text-stone-600 font-normal shadow-sm @error('phone_number') border-red-500 @enderror" 
                                    name="phone_number" 
                                    placeholder="+1234567890" 
                                    type="text"
                                    value="{{ old('phone_number', $user->phone_number) }}"
                                    required
                                />
                                @error('phone_number')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="col-span-1">
                            <label class="flex flex-col gap-2">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.whatsapp') }}</p>
                                <input 
                                    class="form-input w-full rounded-xl border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 placeholder:text-stone-400 dark:placeholder:text-stone-600 font-normal shadow-sm @error('whatsapp') border-red-500 @enderror" 
                                    name="whatsapp" 
                                    placeholder="+1234567890" 
                                    type="text"
                                    value="{{ old('whatsapp', $user->whatsapp) }}"
                                />
                                @error('whatsapp')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="flex flex-col gap-2">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.facebook_url') }}</p>
                                <input 
                                    class="form-input w-full rounded-xl border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 placeholder:text-stone-400 dark:placeholder:text-stone-600 font-normal shadow-sm @error('facebook') border-red-500 @enderror" 
                                    name="facebook" 
                                    placeholder="https://facebook.com/yourprofile" 
                                    type="url"
                                    value="{{ old('facebook', $user->facebook) }}"
                                />
                                @error('facebook')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>
                    </div>
                </section>

                {{-- Store Information Section --}}
                <section class="bg-white dark:bg-stone-dark rounded-lg p-6 sm:p-8 shadow-sm border border-stone-100 dark:border-stone-800">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-primary">storefront</span>
                        <h3 class="text-slate-900 dark:text-white text-xl font-bold leading-tight tracking-[-0.015em]">{{ __('messages.store_information') }}</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1 md:col-span-2">
                            <label class="flex flex-col gap-2">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.store_name') }}</p>
                                <input 
                                    class="form-input w-full rounded-xl border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 placeholder:text-stone-400 dark:placeholder:text-stone-600 font-normal shadow-sm @error('store_name') border-red-500 @enderror" 
                                    name="store_name" 
                                    placeholder="{{ __('messages.store_name') }}" 
                                    type="text"
                                    value="{{ old('store_name', $user->store_name) }}"
                                    required
                                />
                                @error('store_name')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="col-span-1">
                            <label class="flex flex-col gap-2">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.country') }}</p>
                                <input 
                                    class="form-input w-full rounded-xl border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 placeholder:text-stone-400 dark:placeholder:text-stone-600 font-normal shadow-sm @error('country') border-red-500 @enderror" 
                                    name="country" 
                                    placeholder="{{ __('messages.country') }}" 
                                    type="text"
                                    value="{{ old('country', $user->country) }}"
                                    required
                                />
                                @error('country')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="col-span-1">
                            <label class="flex flex-col gap-2">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.city') }}</p>
                                <input 
                                    class="form-input w-full rounded-xl border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary h-14 px-4 placeholder:text-stone-400 dark:placeholder:text-stone-600 font-normal shadow-sm @error('city') border-red-500 @enderror" 
                                    name="city" 
                                    placeholder="{{ __('messages.city') }}" 
                                    type="text"
                                    value="{{ old('city', $user->city) }}"
                                    required
                                />
                                @error('city')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="flex flex-col gap-2">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.details_optional') }}</p>
                                <textarea 
                                    class="form-textarea w-full rounded-xl border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-900 dark:text-white focus:border-primary focus:ring-primary min-h-[140px] p-4 placeholder:text-stone-400 dark:placeholder:text-stone-600 font-normal shadow-sm resize-y @error('details') border-red-500 @enderror" 
                                    name="details" 
                                    placeholder="{{ __('messages.tell_about_store') }}"
                                    rows="3"
                                >{{ old('details', $user->details) }}</textarea>
                                @error('details')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="flex flex-col gap-2">
                                <p class="text-slate-900 dark:text-stone-200 text-base font-medium">{{ __('messages.store_logo_optional') }}</p>
                                @if($user->logo)
                                    <div class="mb-2">
                                        <p class="text-sm text-stone-500 mb-2">{{ __('messages.current_logo') }}</p>
                                        <img src="{{ asset('storage/' . $user->logo) }}" alt="Store Logo" class="size-24 object-cover rounded-xl border border-stone-200 dark:border-stone-700"/>
                                    </div>
                                @endif
                                <input 
                                    class="form-input w-full rounded-xl border-stone-200 dark:border-stone-700 bg-white dark:bg-stone-800 text-slate-900 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-[#181811] hover:file:bg-[#d9d505] focus:border-primary focus:ring-primary h-14 px-4 font-normal shadow-sm @error('logo') border-red-500 @enderror" 
                                    name="logo" 
                                    type="file"
                                    accept="image/*"
                                />
                                @error('logo')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>
                    </div>
                </section>

                <div class="flex flex-col-reverse sm:flex-row justify-end items-center gap-4 pt-6 pb-20">
                    <a href="{{ route('dashboard') }}" class="w-full sm:w-auto flex min-w-[120px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-12 px-6 bg-transparent border border-stone-300 dark:border-stone-700 text-stone-600 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800 text-base font-bold transition-all">
                        {{ __('messages.cancel') }}
                    </a>
                    <button class="w-full sm:w-auto flex min-w-[200px] cursor-pointer items-center justify-center overflow-hidden rounded-full h-12 px-8 bg-primary text-[#181811] hover:bg-[#eae605] text-base font-bold shadow-lg shadow-primary/20 transition-all hover:scale-[1.02] active:scale-95" type="submit">
                        {{ __('messages.save_changes') }}
                    </button>
                </div>
            </form>

            {{-- Danger Zone Section --}}
            <section class="bg-red-50 dark:bg-red-900/20 rounded-lg p-6 sm:p-8 shadow-sm border border-red-200 dark:border-red-800">
                <div class="flex items-center gap-2 mb-6">
                    <span class="material-symbols-outlined text-red-600 dark:text-red-400">warning</span>
                    <h3 class="text-red-900 dark:text-red-200 text-xl font-bold leading-tight tracking-[-0.015em]">{{ __('messages.danger_zone') }}</h3>
                </div>
                <div class="flex flex-col gap-4">
                    <p class="text-red-700 dark:text-red-300 text-sm">
                        {{ __('messages.delete_account_warning') }}
                    </p>
                    <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('{{ __('messages.delete_account_confirm') }}');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex items-center gap-2 rounded-full h-12 px-6 bg-red-600 hover:bg-red-700 text-white text-base font-bold transition-colors shadow-lg shadow-red-600/20">
                            <span class="material-symbols-outlined text-lg">delete</span>
                            <span>{{ __('messages.delete_my_account') }}</span>
                        </button>
                    </form>
                </div>
            </section>
        </div>
    </main>

    @include('partials.footer')

</body>
</html>
