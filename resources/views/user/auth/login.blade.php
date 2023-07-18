@extends('layouts.layout')

@section('title')
    kamiclub | ログイン
@endsection

@section('content')
    <div class="login-page d-flex flex-column justify-content-center align-items-center ">

        <h2 class="login-h2">会員ログイン</h2>

        <form method="POST" action="{{ route('user.login') }}" class="login-form">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" value="メールアドレス" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" value="パスワード" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-primary-button class="btn btn-secondary  mx-auto">
                    ログイン
                </x-primary-button>
            </div>

            <!-- Remember Me -->
            <div class="block">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">ログイン状態を保持する</span>
                </label>
            </div>

            <div class="mt-4">
                @if (Route::has('user.password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('user.password.request') }}">
                        パスワードをお忘れですか？
                    </a>
                @endif
            </div>
        </form>

    </div>
@endsection
