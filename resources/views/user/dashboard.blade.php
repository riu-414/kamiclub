<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            ユーザー用 : ホーム
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col p-6 text-gray-900 dark:text-gray-100">

                    <button type="button" onclick="location.href='{{ route('user.reservation.index') }}'" class="text-gray bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded">予約する</button>

                    <button type="button" onclick="location.href='{{ route('user.parking.index') }}'" class="text-gray bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded">駐車場の空きを確認する</button>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
