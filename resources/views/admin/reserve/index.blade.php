<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            管理者用 : 予約確認
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="reserve-calendar mx-auto sm:px-6 lg:px-8">
            <div class="mt-6 overflow-hidden sm:rounded-lg">
                <div class="p-6">

                    <x-flash-message status="session('status')" />

                    <div class="flex justify-end mb-4">
                        {{-- <button onclick="location.href='{{ route('admin.reserve.past') }}'" class="bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded text-lg">過去の予約</button> --}}
                    </div>

                    @livewire('calendar')

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
