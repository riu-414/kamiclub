<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            管理者用 : 新規予約 - 日付選択
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="reserve-calendar mx-auto sm:px-6 lg:px-8">
            <div class="main mt-6 overflow-hidden sm:rounded-lg">
                <div class="p-6">

                    @livewire('select-calendar')
                    {{-- @livewire('select-calendar') --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
