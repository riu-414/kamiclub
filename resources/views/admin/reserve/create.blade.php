<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            管理者用 : 予約登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="main overflow-hidden sm:rounded-lg">
                <div class="p-6">

                    <div class="mb-4">
                        予約登録
                    </div>

                    <div>
                        日付
                        <input type="text" id="reserve_date" name="reserve_date">
                        開始時間
                        <input type="text" id="start_time" name="start_time">
                        終了時間
                        <input type="text" id="end_time" name="end_time">
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
