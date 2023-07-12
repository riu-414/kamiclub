<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            お客様用 : 駐車場の空き状況
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 border border-green-400">
            <div class="overflow-hidden shadow-sm sm:rounded-lg border border-red-400">

                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-24 mx-auto">

                            <x-flash-message status="session('status')" />

                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                <table class="table-auto max-w-2xl mx-auto text-left whitespace-no-wrap">
                                    <thead>
                                    <tr>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">名前</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">空き状況</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($parkings as $parking)
                                        <tr>
                                            <td class="px-4 py-3">{{ $parking->name }}</td>
                                            <td class="px-4 py-3">{{ $parking->situation }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="p-2 w-full flex justify-center mt-4">
                                    <button type="button" onclick="location.href='{{ route('user.dashboard') }}'" class="text-gray bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                </div>
                            </div>

                        </div>
                    </section>
            </div>
        </div>
    </div>

</x-app-layout>
