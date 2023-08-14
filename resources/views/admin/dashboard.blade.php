<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            管理者用 : ホーム
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="main overflow-hidden sm:rounded-lg">
                <div class="p-6">

                    ホーム

                    <x-flash-message status="session('status')" />

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
