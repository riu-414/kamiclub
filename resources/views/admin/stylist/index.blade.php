<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            管理者用 : スタイリスト一覧
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="main overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-24 mx-auto">

                            <x-flash-message status="session('status')" />

                            <div class="flex justify-end mb-4">
                                <button onclick="location.href='{{ route('admin.stylist.create') }}'" class="bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">新規登録</button>
                            </div>

                            <div class="flex flex-col text-center w-full mb-20">
                            </div>

                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                <tr>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">作成日</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stylists as $stylist)
                                    <tr>
                                        <td class="px-4 py-3">{{ $stylist->name }}</td>
                                        <td class="px-4 py-3">{{ $stylist->created_at }}</td>
                                        <td class="px-4 py-3">
                                            <button onclick="location.href='{{ route('admin.stylist.edit', ['stylist' => $stylist->id]) }}'" class="text-gray bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded">編集する</button>
                                        </td>
                                        <form id="delete_{{$stylist->id}}" method="post" action="{{ route('admin.stylist.destroy', ['stylist' => $stylist->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <td class="px-4 py-3">
                                                <a href="#" data-id="{{$stylist->id}}" onclick="deletePost(this)" class="text-gray bg-rede-400 border-0 py-2 px-8 focus:outline-none hover:bg-red-500 rounded">削除する</a>
                                            </td>
                                        </form>
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

    <script>
        function deletePost(e) {
            'use strict';
            if (confirm('本当に削除してもいいですか？')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>

</x-app-layout>
