<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            管理者用 : 駐車場の空き状況
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-24 mx-auto">

                            <x-flash-message status="session('status')" />

                            <div class="flex flex-col text-center w-full mb-20">
                            </div>

                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                <tr>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">空き状況</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($parkings as $parking)
                                    <tr>
                                        <td class="px-4 py-3">{{ $parking->name }}</td>
                                        <td class="px-4 py-3">{{ $parking->situation }}</td>
                                        {{-- <td class="px-4 py-3">
                                            <button onclick="location.href='{{ route('admin.parking.index', ['parking' => $parking->id]) }}'" class="text-gray bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded">変更する</button>
                                        </td> --}}

                                        <form id="update_{{$parking->id}}" method="post" action="{{ route('admin.parking.update', ['parking' => $parking->id]) }}">
                                            @csrf
                                            @method('PUT')
                                            <td class="px-4 py-3">
                                                <a href="#" data-id="{{$parking->id}}" onclick="confirmationPost(this)" class="text-gray bg-rede-400 border-0 py-2 px-8 focus:outline-none hover:bg-red-500 rounded">変更する</a>
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
        function confirmationPost(e) {
            'use strict';
            if (confirm('変更してもいいですか？')) {
                document.getElementById('update_' + e.dataset.id).submit();
            }
        }
    </script>

</x-app-layout>
