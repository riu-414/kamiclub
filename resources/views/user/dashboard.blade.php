<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            ユーザー用 : ホーム
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="flex flex-col p-6">

                    <button type="button" onclick="location.href='{{ route('user.reservation.future') }}'" class="text-gray bg-blue-300 border-0 w-64 py-2 px-8 mx-auto focus:outline-none hover:bg-blue-600 rounded">予約確認</button>

                    <button type="button" onclick="location.href='{{ route('user.reservation.select-menu') }}'" class="text-gray bg-blue-300 border-0 w-64 mt-8 py-2 px-8 mx-auto focus:outline-none hover:bg-blue-600 rounded">予約する</button>

                    <button type="button" onclick="location.href='{{ route('user.parking.index') }}'" class="text-gray bg-blue-300 border-0 w-64 mt-8 py-2 px-8 mx-auto focus:outline-none hover:bg-blue-600 rounded">駐車場の空きを確認する</button>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
