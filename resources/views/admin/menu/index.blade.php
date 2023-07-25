<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            管理者用 : メニュー
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="main overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-24 mx-auto">

                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">

                                <x-flash-message status="session('status')" />

                                <div class="flex justify-end mb-4">
                                    <button onclick="location.href='{{ route('admin.menu.create') }}'" class="bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-500 rounded text-lg">新規登録</button>
                                </div>

                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                    <tr>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">タイトル</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($menus as $menu)
                                        <tr>
                                            <td class="px-4 py-3">{{ $menu->title }}</td>
                                            <td class="px-4 py-3">
                                                {{-- <button onclick="location.href='{{ route('admin.menu.edit', ['menu' => $menu->id]) }}'" class="text-gray bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded">詳細</button> --}}
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
