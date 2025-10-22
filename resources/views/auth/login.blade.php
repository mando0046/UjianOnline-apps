<x-guest-layout>
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 px-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8">
            <!-- Title -->
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Welcome Guest 👋</h1>
                <p class="text-gray-500 text-sm">Login to continue</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold" />
                    <div class="mt-1 relative">
                        <!-- Icon -->
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 12H8m0 0H6m2 0h2m6-4H8m0 0H6m2 0h2m6 8H8m0 0H6m2 0h2" />
                            </svg>
                        </span>
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                            autocomplete="username"
                            class="block w-full pl-10 pr-3 py-2 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />
                    <div class="mt-1 relative">
                        <!-- Icon -->
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 15c.828 0 1.5-.672 1.5-1.5S12.828 12 12 12s-1.5.672-1.5 1.5S11.172 15 12 15z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17.657 16.657A8 8 0 116.343 6.343a8 8 0 0111.314 11.314z" />
                            </svg>
                        </span>
                        <x-text-input id="password" type="password" name="password" required
                            autocomplete="current-password"
                            class="block w-full pl-10 pr-3 py-2 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember & Forgot -->
                <div class="flex items-center justify-between text-sm">
                    <label for="remember_me" class="flex items-center space-x-2">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="text-gray-600">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="font-medium text-indigo-600 hover:text-indigo-800">
                            {{ __('Forgot Password?') }}
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <div>
                    <x-primary-button
                        class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-lg transition ease-in-out duration-150">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Divider -->
            <div class="my-6 flex items-center">
                <hr class="flex-grow border-gray-300">
                <span class="mx-2 text-gray-400 text-sm">or</span>
                <hr class="flex-grow border-gray-300">
            </div>

            <!-- Social login -->
            <div class="flex gap-3">
                <button
                    class="flex-1 py-2 px-4 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-50 transition">
                    <svg class="h-5 w-5 mr-2" viewBox="0 0 48 48">
                        <path fill="#EA4335"
                            d="M24 9.5c3.94 0 6.61 1.71 8.13 3.14l5.98-5.98C34.09 3.45 29.5 1.5 24 1.5 14.49 1.5 6.5 7.92 3.68 16.5h7.98c1.53-4.57 5.94-7 12.34-7z" />
                        <path fill="#4285F4"
                            d="M46.5 24c0-1.64-.15-3.21-.44-4.72H24v9h12.69c-.55 2.85-2.2 5.26-4.68 6.85l7.39 5.74C43.9 36.28 46.5 30.55 46.5 24z" />
                        <path fill="#FBBC05"
                            d="M11.66 28.5c-.48-1.44-.75-2.98-.75-4.5s.27-3.06.75-4.5l-7.98-6C2.27 16.92 1.5 20.37 1.5 24s.77 7.08 2.18 10.5l7.98-6z" />
                        <path fill="#34A853"
                            d="M24 46.5c6.48 0 11.91-2.14 15.88-5.8l-7.39-5.74c-2.05 1.38-4.69 2.2-8.49 2.2-6.39 0-10.8-4.43-12.34-9H3.68c2.82 8.58 10.81 15 20.32 15z" />
                    </svg>
                    Google
                </button>
                <button
                    class="flex-1 py-2 px-4 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-50 transition">
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 4.56c-.89.39-1.84.65-2.84.77a4.92 4.92 0 002.16-2.71..." />
                    </svg>
                    Twitter
                </button>
            </div>

            <!-- Register link -->
            <div class="mt-6 text-center text-sm text-gray-600">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:text-indigo-800">
                    {{ __('Register') }}
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
