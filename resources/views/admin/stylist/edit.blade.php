<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            管理者用 : スタイリスト編集
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 py-24 mx-auto">

                            {{-- <div class="flex flex-col text-center w-full mb-12">
                            </div> --}}

                            {{-- <div class="lg:w-1/2 md:w-2/3 mx-auto"> --}}
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <form method="post" action="{{ route('admin.stylist.update', ['stylist' => $stylist->id]) }}">
                                    @method('PUT')
                                    @csrf
                                    <div class="-m-2">

                                        <div class="p-2 w-1/2 mx-auto">
                                            <div class="relative">
                                                <label for="name" class="leading-7 text-sm text-gray-600">名前</label>
                                                <input type="text" id="name" name="name" value="{{ $stylist->name }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-full flex justify-center mt-4">
                                            <button type="submit" class="text-gray bg-blue-500 border-0 mr-8 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新する</button>
                                            <button type="button" onclick="location.href='{{ route('admin.stylist.index') }}'" class="text-gray bg-gray-200 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
