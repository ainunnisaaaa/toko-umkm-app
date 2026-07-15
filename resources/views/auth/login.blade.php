<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-tokopedia">Welcome Back!</h2>
        <p class="text-gray-500 text-sm mt-2 font-medium">Please sign in to your account to continue</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="relative group">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1 transition-colors group-focus-within:text-tokopedia">Email Address</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-tokopedia transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl leading-5 bg-white bg-opacity-50 backdrop-blur-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-tokopedia focus:border-tokopedia focus:bg-white transition-all duration-300 sm:text-sm shadow-sm hover:border-gray-300" placeholder="you@example.com">
            </div>
            @error('email')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="relative group">
            <div class="flex items-center justify-between mb-1">
                <label for="password" class="block text-sm font-medium text-gray-700 transition-colors group-focus-within:text-tokopedia">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-tokopedia hover:text-tokopedia-dark transition-colors">
                        Forgot password?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400 group-focus-within:text-tokopedia transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl leading-5 bg-white bg-opacity-50 backdrop-blur-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-tokopedia focus:border-tokopedia focus:bg-white transition-all duration-300 sm:text-sm shadow-sm hover:border-gray-300" placeholder="••••••••">
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 text-tokopedia focus:ring-tokopedia border-gray-300 rounded cursor-pointer transition-colors">
            <label for="remember_me" class="ml-2 block text-sm text-gray-700 cursor-pointer">
                Remember me
            </label>
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg shadow-tokopedia/30 text-sm font-semibold text-white bg-tokopedia hover:bg-tokopedia-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-tokopedia transform hover:-translate-y-0.5 transition-all duration-300">
                Sign In
            </button>
        </div>
        
        <div class="mt-6 text-center text-sm text-gray-600">
            Don't have an account? 
            <a href="{{ route('register') }}" class="font-medium text-tokopedia hover:text-tokopedia-dark transition-colors">
                Sign up now
            </a>
        </div>
    </form>
</x-guest-layout>
