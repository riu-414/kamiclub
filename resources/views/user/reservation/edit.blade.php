<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            ユーザー者用 : 予約編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="main overflow-hidden sm:rounded-lg">
                <div class="p-6">

                    <div class="mb-4 flex justify-center">
                        予約編集
                    </div>

                    @foreach ($errors->all() as $error)
                        <div class="text-red-500 text-center">{{$error}}</div>
                    @endforeach

                    <div class="lg:w-1/2 md:w-2/3 mx-auto">
                        <form method="post" action="{{ route('user.reservation.update',  ['reservation' => $reserve->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="-m-2">

                                <div class="p-2 w-1/2 mx-auto">
                                    <div class="relative">
                                        <label for="name" class="leading-7 text-sm text-gray-600">名前</label>
                                        <input type="text" id="name" name="name" value="{{ $reserve->name }}" class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>

                                    <div class="relative mt-4">
                                        <label for="menu" class="leading-7 text-sm text-gray-600">メニュー</label>
                                        <select id="menu" name="menu" class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            <option value="カット - ¥4,000 - 1.0h">カット - ¥4,000 - 1.0h</option>
                                            <option value="パーマ - ¥10,000 - 1.0h">パーマ - ¥10,000 - 1.0h</option>
                                        </select>
                                    </div>

                                    <div class="relative mt-4">
                                        <label for="message" class="leading-7 text-sm text-gray-600">お店へのご要望</label>
                                        <textarea name="message" id="message" rows="3" class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{!! nl2br(e($reserve->message)) !!}</textarea>
                                    </div>

                                    <div class="relative mt-4">
                                        <label for="reserve_date">日付</label>
                                        <input type="text" id="reserve_date" name="reserve_date" value="{{ $reserveDate }}" class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>

                                    <div class="relative mt-4">
                                        <label for="start_time">開始時間</label>
                                        <input type="text" id="start_time" name="start_time" value="{{ $startTime }}" class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>

                                    {{-- <div class="relative mt-4">
                                        <label for="end_time">終了時間</label>
                                        <input type="text" id="end_time" name="end_time" value="{{ $endTime }}" class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div> --}}
                                </div>

                                <div class="p-2 w-full flex justify-center mt-4">
                                    <button type="submit" class="text-gray bg-blue-300 border-0 mr-16 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded text-lg">更新する</button>
                                    <button type="button" onclick="location.href='{{ route('user.reservation.show', ['reservation' => $reserve->id]) }}'" class="text-gray bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
