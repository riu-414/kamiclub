<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            ユーザー用 : 新規予約
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="reserve-calendar mx-auto sm:px-6 lg:px-8">
            <div class="mt-6 overflow-hidden sm:rounded-lg">
                <div class="p-6">

                    <x-flash-message status="session('status')" />

                    <div class="flex justify-end mb-4">
                        <button onclick="location.href='{{ route('user.reservation.create') }}'" class="mr-8 bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded text-lg">新規登録</button>

                        <button onclick="location.href='{{ route('user.dashboard') }}'" class="mr-8 bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                    </div>

                    @livewire('user-calendar')

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
