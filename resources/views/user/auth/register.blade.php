@extends('layouts.layout')

@section('title')
    kamiclub | 新規登録
@endsection

@section('content')
    <div class="register-page d-flex flex-column justify-content-center align-items-center ">

        <h2 class="register-h2">新規登録</h2>

        <form method="POST" action="{{ route('user.register') }}">
            @csrf

            <!-- Name -->
            <div class="">
                <x-input-label for="name" value="名前" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- sex -->
            <div class="mt-4">
                <x-input-label for="sex" value="性別" />
                <input type="radio" id="sex" name="sex" value="男性" required autofocus autocomplete="sex">男性
                <input type="radio" id="sex" name="sex" value="女性" required autofocus autocomplete="sex">女性
                <x-input-error :messages="$errors->get('sex')" class="mt-2" />
            </div>

            <!-- birthday -->
            <div class="mt-4">
                <x-input-label for="birthday" value="誕生日" />
                <x-text-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday')" required autofocus autocomplete="birthday" placeholder="例)19990101"/>
                <x-input-error :messages="$errors->get('birthday')" class="mt-2" />
            </div>

            <!-- phone -->
            <div class="mt-4">
                <x-input-label for="phone" value="電話番号" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" placeholder="ハイフンなしで入力"/>
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" value="メールアドレス" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" value="パスワード" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" value="パスワードの確認" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('user.login') }}">
                    登録済みの方はこちら
                </a>

                <x-primary-button class="btn btn-secondary ml-4">
                    登録する
                </x-primary-button>
            </div>
        </form>

    </div>
@endsection
