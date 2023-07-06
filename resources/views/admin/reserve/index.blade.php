<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            管理者用 : 今日以降の予約
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="main mt-6 overflow-hidden sm:rounded-lg">
                <div class="p-6">

                    <div class="flex justify-end mb-4">
                        <button onclick="location.href='{{ route('admin.reserve.create') }}'" class="mr-8 bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded text-lg">新規登録</button>

                        <button onclick="location.href='{{ route('admin.reserve.past') }}'" class="bg-blue-300 border-0 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded text-lg">過去の予約</button>
                    </div>

                    {{-- <livewire:calendar /> --}}
                    @livewire('calendar')

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
