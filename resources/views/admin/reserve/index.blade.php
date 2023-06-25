<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            管理者用 : 予約確認
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="main overflow-hidden sm:rounded-lg">
                <div class="p-6">

                    <section class="body-font">
                        <div class="container px-5 py-24 mx-auto">

                            <div class="flex justify-end mb-4">
                                <button onclick="location.href='{{ route('admin.reserve.create') }}'" class="bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">新規登録</button>
                            </div>

                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                    <tr>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-sm bg-gray-100">メニュー</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-sm bg-gray-100">お店へのご要望</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-sm bg-gray-100">開始時間</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-sm bg-gray-100">終了時間</th>
                                        <th class="w-10 title-font tracking-wider font-medium text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reserves as $reserve)
                                            <tr>
                                                <td class="px-4 py-3">{{ $reserve->name }}</td>
                                                <td class="px-4 py-3">{{ $reserve->menu }}</td>
                                                <td class="px-4 py-3">{{ $reserve->message }}</td>
                                                <td class="px-4 py-3">{{ $reserve->start_date }}</td>
                                                <td class="px-4 py-3">{{ $reserve->end_date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $reserves->links() }}
                            </div>

                        </div>
                        </section>

                </div>
            </div>

            <div class="main mt-6 overflow-hidden sm:rounded-lg">
                <div class="p-6">

                    今日の予定

                    {{-- <livewire:calendar /> --}}
                    {{-- @livewire('calendar') --}}

                </div>
            </div>


        </div>
    </div>
</x-app-layout>
