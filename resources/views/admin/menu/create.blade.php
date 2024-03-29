<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            管理者用 : メニュー登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6">

                    <div class="mb-4 flex justify-center">
                        メニュー登録
                    </div>

                    @foreach ($errors->all() as $error)
                        <div class="text-red-500 text-center">{{$error}}</div>
                    @endforeach

                    <div class="lg:w-1/2 md:w-2/3 mx-auto">
                        <form method="post" action="{{ route('admin.menu.store') }}">
                            @csrf
                            <div class="-m-2">

                                <div class="p-2 w-1/2 mx-auto">
                                    <div class="relative">
                                        <label for="title">タイトル</label>
                                        <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>

                                    <div class="relative mt-4">
                                        <label for="content">内容</label>
                                        <textarea name="content" id="content" rows="3" value="{{ old('content') }}" class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ old('content') }}</textarea>
                                    </div>

                                    <div class="relative mt-4">
                                        <label for="price">料金</label>
                                        <input type="text" id="price" name="price" value="{{ old('price') }}" class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>

                                    <div class="relative mt-4">
                                        <label for="">施術時間</label>
                                        <div class="flex justify-center">
                                            <select id="menu_hour" name="menu_hour" class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                <option value="0">0時間</option>
                                                <option value="1">1時間</option>
                                                <option value="2">2時間</option>
                                                <option value="3">3時間</option>
                                            </select>
                                            <select id="menu_minutes" name="menu_minutes" class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                <option value="0">00分</option>
                                                <option value="30">30分</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-2 w-full flex justify-center mt-4">
                                    <button type="submit" class="text-gray bg-blue-300 border-0 mr-16 py-2 px-8 focus:outline-none hover:bg-blue-400 rounded text-lg">登録する</button>
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
