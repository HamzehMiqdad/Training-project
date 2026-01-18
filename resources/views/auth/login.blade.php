<!DOCTYPE html>
<html class="light" lang="en">
<head>
    @include('partials.auth-head')
</head>
<body class="bg-background-light dark:bg-background-dark text-text-main dark:text-white transition-colors duration-200 min-h-screen flex flex-col">
    @include('partials.auth-header')

    <main class="flex-grow flex items-center justify-center p-4 lg:p-10">
        <div class="w-full max-w-[1200px] bg-surface-light dark:bg-surface-dark rounded-xl lg:rounded-2xl overflow-hidden shadow-sm dark:shadow-none min-h-[700px] flex flex-col lg:flex-row border border-[#e6e6db] dark:border-[#3e3d24]">
            <div class="w-full lg:w-1/2 p-8 lg:p-16 flex flex-col justify-center relative">
                <div class="max-w-[420px] mx-auto w-full">
                    <div class="mb-10 text-center">
                        <h1 class="text-3xl lg:text-4xl font-bold mb-3 text-text-main dark:text-white">Welcome Back</h1>
                        <p class="text-text-muted dark:text-[#a3a38a]">Enter your details to access your account.</p>
                    </div>

                    <div class="mb-8">
                        <div class="flex border-b border-[#e6e6db] dark:border-[#3e3d24]">
                            <button class="flex-1 pb-4 border-b-[3px] border-primary text-text-main dark:text-white font-bold text-sm transition-all">
                                Log In
                            </button>
                            <a href="{{ route('register') }}" class="flex-1 pb-4 border-b-[3px] border-transparent text-text-muted hover:text-text-main dark:hover:text-white font-bold text-sm transition-all text-center">
                                Sign Up
                            </a>
                        </div>
                    </div>

                {{-- Display Validation Errors --}}
                @if ($errors->any())
                        <div class="mb-5 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-full">
                            <ul class="mb-0 text-sm text-red-600 dark:text-red-400">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                    <form method="POST" action="{{ route('login.attempt') }}" class="flex flex-col gap-5">
                    @csrf

                        <label class="flex flex-col gap-2">
                            <span class="text-sm font-bold text-text-main dark:text-white ml-1">Email Address</span>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-muted select-none pointer-events-none">mail</span>
                                <input 
                                    class="w-full h-14 bg-background-light dark:bg-background-dark border border-[#e6e6db] dark:border-[#3e3d24] rounded-full px-12 text-base text-text-main dark:text-white placeholder:text-text-muted focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('email') border-red-500 @enderror" 
                                    placeholder="name@example.com" 
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                />
                    </div>

                        </label>

                        <label class="flex flex-col gap-2">
                            <div class="flex justify-between items-center ml-1">
                                <span class="text-sm font-bold text-text-main dark:text-white">Password</span>
                            </div>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-muted select-none pointer-events-none">lock</span>
                                <input 
                                    class="w-full h-14 bg-background-light dark:bg-background-dark border border-[#e6e6db] dark:border-[#3e3d24] rounded-full px-12 text-base text-text-main dark:text-white placeholder:text-text-muted focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('password') border-red-500 @enderror" 
                                    placeholder="••••••••" 
                                    type="password"
                                    name="password"
                                    id="password"
                                    required
                                />
                                <button 
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-text-muted hover:text-text-main dark:hover:text-white transition-colors" 
                                    type="button"
                                    onclick="togglePasswordVisibility()"
                                >
                                    <span class="material-symbols-outlined text-xl" id="password-toggle-icon">visibility</span>
                                </button>
                    </div>

                        </label>

                        <div class="flex items-center ml-1">
                            <input 
                                class="w-5 h-5 rounded border border-[#e6e6db] dark:border-[#3e3d24] text-primary bg-background-light dark:bg-background-dark focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all cursor-pointer" 
                                id="remember_me" 
                                type="checkbox"
                                name="remember"
                                {{ old('remember') ? 'checked' : '' }}
                            />
                            <label class="ml-3 text-sm font-medium text-text-muted hover:text-text-main dark:hover:text-white cursor-pointer select-none transition-colors" for="remember_me">
                                Remember me
                            </label>
                        </div>

                        <button class="w-full h-14 bg-primary hover:bg-[#d9d505] text-[#181811] font-bold rounded-full text-base mt-2 transition-colors shadow-[0_4px_14px_rgba(249,245,6,0.3)]" type="submit">
                            Log In
                        </button>
                    </form>

                    <p class="text-center mt-8 text-sm text-text-muted">
                        Don't have an account? <a class="text-text-main dark:text-white font-bold underline decoration-primary decoration-2 underline-offset-4 hover:decoration-[#d9d505]" href="{{ route('register') }}">Sign up</a>
                    </p>
                </div>
            </div>

            <div class="hidden lg:block w-1/2 bg-background-light dark:bg-[#1a190b] relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-full h-full">
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" data-alt="Modern abstract shopping bags and discount tags on a vibrant yellow background" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCsY-c7lTsP965MJrzT4n7FTVliUcHYy-njk6ris-PD19HS2docsehx8WTIdPpFy4rFKTqo1gbw2FrMWr4x_TOIDgUDVHnq7OHkOtmsCroUS0TOV1V2i4s84fNH1JW8_5V-QB6QZA6QQJbpFtzyzbQrQp4oPP2gJyWmuJQn6tQsXuLpV-CchJT2UaK7AKSIj24jrHqR2g22DPzvWl9uoYrDNIYZroCx77vJDmDUG0Wv6snt63lqIuwO1HwNb7LLKn44vFAavbFeCZQ');">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60"></div>
                </div>
                <div class="absolute bottom-16 left-12 right-12 text-white">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/20 backdrop-blur-md rounded-full mb-4 border border-white/20">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                        <span class="text-xs font-medium">New Collection Dropped</span>
                    </div>
                    <h3 class="text-3xl font-bold mb-4 leading-tight">Join the fastest growing marketplace for creators.</h3>
                    <div class="flex items-center gap-4">
                        <div class="flex -space-x-3">
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-200 bg-cover bg-center" data-alt="Portrait of a female user smiling" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCShToIGyn5RXPLZ-D9b2ffHBKNQhpkG3F3w3t_ziF8XcdfNkc5cKCj6Y-8mw_hgpXTyNqhZTsPRCgNatc4gRq0AjBfGyvXXj6rWb2VYo16njU6WB0ajgo1AR7gRS_CRO4m7pqI2xVnIA7gkd-nL3FlO6DorMoN9rdcWjFW2doK2fhjDKxhRnkVc66Hr4X3IjaLjQJN2znKhnplAcHkk5tawhrKGPEI5YxGPLuVghIBx8NJL6IzNVkobg32Ucr_iPZbAoxHy5nkI2w')"></div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-200 bg-cover bg-center" data-alt="Portrait of a male user looking forward" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDzWDUxlyJaRxBVquw08NLiONs_xk5VKHm6MNLMXSX1VzanAjYEWk8vzA764D8yr8Hc4BUQHq0KPZIJAjryLtF9MwxQ-uv1BkJqixvd60Pm6GZ8CFs0IIgZ0P33GESiByEkQbWdtyBxhj2_0R2jmz2Q2Vsf5mw1lgweqlJf_BGnI8o3pIgPNE-f6AgExtwgxAt_wm2q997sLO-xDuZirFJJpeG1krGfo7t0vxtd0o6RzNMV8W4HL_dM69TBfVv-NE1aOVezpmbqM4I')"></div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-gray-200 bg-cover bg-center" data-alt="Portrait of a male user smiling with glasses" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuC2_tLcu-XGdUBlLUu1Uab9nMfHt1ZVFVze3JbIEJ2VV-qCaPrMQR2u0ecT7yrli2hYMNM6UBQxDYpmuGa-q9gbU-iX3kmI74BuzqY0q4zBo8cPUBxDktO1anZyEb7gVTniI5CwUNbJoaVUu1xfWwSLrfK6KoSpjLdSdOkiKe35jFVggYHK4u2RT3RAud1NAvtuPoI9zkWICX19OrdzxaBr5ISqRtGTmgD8NRbVcmsfshLot0L039bPIg1NW3sbRwpw3IuUk8sHrFE')"></div>
                            <div class="w-10 h-10 rounded-full border-2 border-white bg-primary text-[#181811] flex items-center justify-center text-xs font-bold">+2k</div>
                        </div>
                        <p class="text-sm font-medium text-white/90">Creators joined this week</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('partials.auth-footer')

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('password-toggle-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = 'visibility';
            }
        }
    </script>
</body>
</html>
