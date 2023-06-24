<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            管理者用 : 予約確認
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="main overflow-hidden sm:rounded-lg">
                <div class="p-6">

                    今日の予定

                    {{-- <livewire:calendar /> --}}
                    {{-- @livewire('calendar') --}}

                </div>
            </div>

            <div class="main mt-6 overflow-hidden sm:rounded-lg">
                <div class="p-6">

                    今日の予定<br>

                </div>
            </div>


        </div>
    </div>
</x-app-layout>
