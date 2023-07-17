<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            ユーザー用 : 今日以降の予約状況
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="main overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <section class="text-gray-800 body-font">
                        <div class="container px-5 py-24 mx-auto">


                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">

                                <x-flash-message status="session('status')" />

                                <div class="mt-8 mb-8 text-center text-red-600">
                                    ※当日の変更やキャンセルは電話でお願いします。
                                    <br>
                                    TEL:025-333-8325
                                </div>

                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                    <tr>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">予約日</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メニュー</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">お店へのご要望</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reserves as $reserve)
                                        <tr>
                                            <td class="px-4 py-3">{{ $reserve->start_date }}</td>
                                            <td class="px-4 py-3">{{ $reserve->menu }}</td>
                                            <td class="px-4 py-3">{{ $reserve->message }}</td>
                                            <td class="px-4 py-3">
                                                <button onclick="location.href='{{ route('user.reservation.show', ['reservation' => $reserve->id]) }}'" class="text-gray bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded">詳細</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                            <div class="flex justify-center mt-12">
                                <button onclick="location.href='{{ route('user.dashboard') }}'" class="bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
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
