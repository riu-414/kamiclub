<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            ユーザー用 : 予約詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="main overflow-hidden sm:rounded-lg">
                <div class="p-6">

                    <div class="mb-4 flex justify-center">
                        予約詳細
                    </div>

                    <div class="lg:w-1/2 md:w-2/3 mx-auto">
                        <form method="get" action="{{ route('user.reservation.edit', ['reservation' => $reserve->id]) }}">

                            <div class="-m-2">

                                <div class="p-2 w-1/2 mx-auto">
                                    <div class="relative">
                                        <label for="name" class="leading-7 text-sm text-gray-600">名前</label>
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"> {{ $reserve->name }}</div>
                                    </div>

                                    <div class="relative mt-4">
                                        <label for="menu" class="leading-7 text-sm text-gray-600">メニュー</label>
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"> {{ $reserve->menu }}</div>
                                    </div>

                                    <div class="relative mt-4">
                                        <label for="message" class="leading-7 text-sm text-gray-600">お店へのご要望</label>
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"> {!! nl2br(e($reserve->message)) !!}</div>
                                    </div>

                                    <div class="relative mt-4">
                                        <label for="start_time">予約日</label>
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"> {{ $reserveDate }}</div>
                                    </div>

                                    <div class="relative mt-4">
                                        <label for="start_time">開始時間</label>
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"> {{ $startTime }}</div>
                                    </div>

                                    <div class="relative mt-4">
                                        <label for="end_time">終了予定時間</label>
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"> {{ $endTime }}</div>
                                    </div>
                                </div>

                                <div class="p-2 w-full flex justify-center mt-4">
                                    @if ($reserveDate >= \Carbon\Carbon::today()->format('Y年m月d日'))
                                        <button type="submit" class="text-gray bg-blue-300 border-0 mr-16 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded text-lg">編集する</button>
                                    @endif
                                    <button type="button" onclick="location.href='{{ route('user.reservation.future') }}'" class="text-gray bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
