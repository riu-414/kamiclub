<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            管理者用 : スタイリスト一覧
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-24 mx-auto">

                            <x-flash-message status="info" />

                            <div class="flex justify-end mb-4">
                                <button onclick="location.href='{{ route('admin.stylist.create') }}'" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">新規登録</button>
                            </div>

                            <div class="flex flex-col text-center w-full mb-20">
                            </div>

                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                <tr>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100  rounded-tl rounded-bl">名前</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">作成日</th>
                                    <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stylists as $stylist)
                                    <tr>
                                        <td class="px-4 py-3">{{ $stylist->name }}</td>
                                        <td class="px-4 py-3">{{ $stylist->created_at }}</td>
                                        <td class="w-10 text-center">
                                        {{-- <input name="plan" type="radio"> --}}
                                        <button onclick="location.href='{{ route('admin.stylist.edit', ['stylist' => $stylist->id]) }}'" class="text-gray bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded">編集する</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
