<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            管理者用 : 新規予約 - メニュー選択
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <section class="text-gray-600 body-font ">
                        <div class="container px-5 py-12 mx-auto">

                            <div class="mb-8 text-center font-bold">
                                <p>スタイリストとメニューを選択してください。</p>
                            </div>

                            <div class="lg:w-2/3 w-full mx-auto p-2 overflow-auto">

                                <div class="relative mb-12 w-1/3">
                                    <label for="stylist">スタイリスト選択</label>
                                    <select id="stylist" name="stylist" class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        @foreach ($stylists as $stylist)
                                            <option value="{{ $stylist->id }}">{{ $stylist->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @foreach ($menus as $menu)
                                    <div class="h-40 mb-8 flex border border-gray-600 rounded bg-neutral-50">
                                        <div class="h-40 w-3/4 border border-gray-600">
                                            <div class="m-2 h-1/6 flex justify-between font-bold rounded bg-blue-100">
                                                <div>{{ $menu->title }}</div>
                                                <div>{{ "施術時間". " " . $menu->menu_hour . "時間" . $menu->menu_minutes . "分" . " " . "|" . " " . "¥" . $menu->price }}</div>
                                            </div>
                                            <div class="m-2 h-4/6">
                                                {!! nl2br(e($menu->content)) !!}
                                            </div>
                                        </div>
                                        <div class="h-40 w-1/4 flex justify-center items-center border border-gray-600">
                                            <button onclick="redirectToCalendar('{{ $menu->id }}')" class="w-38 bg-blue-300 border-0 text-gray-500 focus:outline-none hover:bg-blue-400 rounded text-lg">空席確認・予約</button>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>

    <script>
        function redirectToCalendar(menuId) {
            var stylistId = document.getElementById('stylist').value;
            var url = "{{ route('admin.reserve.select-calendar') }}" + "?menuId=" + menuId + "&stylistId=" + stylistId;
            location.href = url;
        }
    </script>

</x-app-layout>
