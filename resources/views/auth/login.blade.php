@extends('layouts.page')

@section('content')

    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-gray-700 shadow-sm focus:border-gray-400 dark:focus:border-gray-600 focus:ring focus:ring-gray-200 dark:focus:ring-gray-700 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-lg text-gray-600 dark:text-gray-500">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 sm:gap-3 items-start sm:items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-lg" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button>
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </x-auth-card>

@endsection
