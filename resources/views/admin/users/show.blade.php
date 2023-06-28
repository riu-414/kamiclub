<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            管理者用 : お客様情報
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-24 mx-auto">

                            <div class="lg:w-1/2 md:w-2/3 mx-auto">

                                <div class="-m-2">

                                    <div class="mb-4 p-2 w-1/2 mx-auto">
                                        <div class="relative">
                                            <label for="name" class="leading-7 text-sm text-gray-600">名前</label>
                                            <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"> {{ $user->name }}</div>
                                        </div>
                                    </div>

                                    <div class="mb-4 p-2 w-1/2 mx-auto">
                                        <div class="relative">
                                            <label for="name" class="leading-7 text-sm text-gray-600">メールアドレス</label>
                                            <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"> {{ $user->email }}</div>
                                        </div>
                                    </div>

                                    <div class="mb-4 p-2 w-1/2 mx-auto">
                                        <div class="relative">
                                            <label for="name" class="leading-7 text-sm text-gray-600">登録日</label>
                                            <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"> {{ $user->created_at }}</div>
                                        </div>
                                    </div>

                                    <div class="p-2 w-full flex justify-center mt-4">
                                        <button type="button" onclick="location.href='{{ route('admin.users.index') }}'" class="text-gray bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>

    <script>
        function deletePost(e) {
            'use strict';
            if (confirm('本当に削除してもいいですか？')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>

</x-app-layout>
