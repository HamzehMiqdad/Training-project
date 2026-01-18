<!DOCTYPE html>
<html class="light" lang="en">
<head>
    @include('partials.auth-head')
    <title>Admin Login - MarketPlace</title>
</head>
<body class="bg-background-light dark:bg-background-dark text-text-main dark:text-white transition-colors duration-200 min-h-screen flex flex-col">
    @include('partials.auth-header')

    <main class="flex-grow flex items-center justify-center p-4 lg:p-10">
        <div class="w-full max-w-md bg-surface-light dark:bg-surface-dark rounded-xl lg:rounded-2xl overflow-hidden shadow-sm dark:shadow-none border border-[#e6e6db] dark:border-[#3e3d24] p-8 lg:p-12">
            <div class="text-center mb-8">
                <div class="size-16 bg-primary rounded-xl flex items-center justify-center text-[#181811] mx-auto mb-4">
                    <span class="material-symbols-outlined text-4xl">admin_panel_settings</span>
                </div>
                <h1 class="text-3xl lg:text-4xl font-bold mb-3 text-text-main dark:text-white">Admin Login</h1>
                <p class="text-text-muted dark:text-[#a3a38a]">Access the admin panel</p>
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

            <form method="POST" action="{{ route('admin.login') }}" class="flex flex-col gap-5">
                @csrf

                <label class="flex flex-col gap-2">
                    <span class="text-sm font-bold text-text-main dark:text-white ml-1">Email Address</span>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-text-muted select-none pointer-events-none">mail</span>
                        <input 
                            class="w-full h-14 bg-background-light dark:bg-background-dark border border-[#e6e6db] dark:border-[#3e3d24] rounded-full px-12 text-base text-text-main dark:text-white placeholder:text-text-muted focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('email') border-red-500 @enderror" 
                            placeholder="admin@example.com" 
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                        />
                    </div>
                </label>

                <label class="flex flex-col gap-2">
                    <span class="text-sm font-bold text-text-main dark:text-white ml-1">Password</span>
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

                <button class="w-full h-14 bg-primary hover:bg-[#d9d505] text-[#181811] font-bold rounded-full text-base mt-2 transition-colors shadow-[0_4px_14px_rgba(249,245,6,0.3)]" type="submit">
                    Login
                </button>
            </form>
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
