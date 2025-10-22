<x-guest-layout>
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 px-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8">
            <!-- Title -->
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Create Account ✨</h1>
                <p class="text-gray-500 text-sm">Sign up to get started</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 font-semibold" />
                    <div class="mt-1 relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <!-- User Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 21a8.25 8.25 0 1115 0" />
                            </svg>
                        </span>
                        <x-text-input id="name" name="name" type="text" :value="old('name')" required autofocus
                            autocomplete="name"
                            class="block w-full pl-10 pr-3 py-2 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold" />
                    <div class="mt-1 relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <!-- Email Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 12H8m0 0H6m2 0h2m6-4H8m0 0H6m2 0h2m6 8H8m0 0H6m2 0h2" />
                            </svg>
                        </span>
                        <x-text-input id="email" name="email" type="email" :value="old('email')" required
                            autocomplete="username"
                            class="block w-full pl-10 pr-3 py-2 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />
                    <div class="mt-1 relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <!-- Lock Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M12 15c.828 0 1.5-.672 1.5-1.5S12.828 12 12 12s-1.5.672-1.5 1.5S11.172 15 12 15z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M17.657 16.657A8 8 0 116.343 6.343a8 8 0 0111.314 11.314z" />
                            </svg>
                        </span>
                        <x-text-input id="password" name="password" type="password" required
                            autocomplete="new-password"
                            class="block w-full pl-10 pr-3 py-2 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-semibold" />
                    <div class="mt-1 relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <!-- Confirm Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0a9 9 0 0118 0z" />
                            </svg>
                        </span>
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" required
                            autocomplete="new-password"
                            class="block w-full pl-10 pr-3 py-2 rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Register Button -->
                <div>
                    <x-primary-button
                        class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 rounded-lg transition ease-in-out duration-150">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Divider -->
            <div class="my-6 flex items-center">
                <hr class="flex-grow border-gray-300">
                <span class="mx-2 text-gray-400 text-sm">or</span>
                <hr class="flex-grow border-gray-300">
            </div>

            <!-- Social Register -->
            <div class="flex gap-3">
                <button
                    class="flex-1 py-2 px-4 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-50 transition">
                    <svg class="h-5 w-5 mr-2" viewBox="0 0 48 48">
                        <path fill="#EA4335" d="M24 9.5c3.94 0..." />
                    </svg>
                    Google
                </button>
                <button
                    class="flex-1 py-2 px-4 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-50 transition">
                    <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 4.56c-.89.39..." />
                    </svg>
                    Twitter
                </button>
            </div>

            <!-- Already have account -->
            <div class="mt-6 text-center text-sm text-gray-600">
                {{ __('Already registered?') }}
                <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-800">
                    {{ __('Login') }}
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
