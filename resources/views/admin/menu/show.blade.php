<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            管理者用 : メニュー詳細
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

                        <form method="get" action="{{ route('admin.menu.edit', ['menu' => $menu->id]) }}">
                            <div class="-m-2">
                                <div class="p-2 w-1/2 mx-auto">
                                    <div class="relative">
                                        <label for="name">タイトル</label>
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"> {{ $menu->title }}</div>
                                    </div>

                                    <div class="relative mt-4">
                                        <label for="message">内容</label>
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"> {!! nl2br(e($menu->content)) !!}</div>
                                    </div>

                                    <div class="relative">
                                        <label for="name">料金</label>
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"> {{ $menu->price }}</div>
                                    </div>
                                </div>

                                <div class="p-2 w-full flex justify-center my-4">
                                    <button type="submit" class="text-gray bg-blue-300 border-0 mr-16 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded text-lg">編集</button>
                                    <button type="button" onclick="location.href='{{ route('admin.menu.index') }}'" class="text-gray bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
