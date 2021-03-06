<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Nhớ mật khẩu') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Quên mật khẩu?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Đăng nhập') }}
                </x-button>

            </div>
            <div class="flex items-center justify-center mt-4">
                <a href="/login-facebook">
                    <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTciIGhlaWdodD0iMjgiIHZpZXdCb3g9IjAgMCAxNyAyOCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4NCiAgICA8cGF0aCBkPSJNMTcgMTAuNzY5MkgxMS4zMzMzVjYuNDYxNTRDMTEuMzMzMyA1LjI3MjYyIDEyLjM0ODggNS4zODQ2MiAxMy42IDUuMzg0NjJIMTUuODY2N1YwSDExLjMzMzNDNy41Nzc0NyAwIDQuNTMzMzMgMi44OTI2MiA0LjUzMzMzIDYuNDYxNTRWMTAuNzY5MkgwVjE2LjE1MzhINC41MzMzM1YyOEgxMS4zMzMzVjE2LjE1MzhIMTQuNzMzM0wxNyAxMC43NjkyWiIgZmlsbD0iIzE5NzZEMiIvPg0KPC9zdmc+DQo="
                        alt="Facebook">
                </a>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
