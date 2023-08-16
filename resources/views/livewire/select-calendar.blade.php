<div>
    <div class="text-center">
        カレンダー
    </div>

    <div class="text-center text-sm mt-4">
        本日から60日先まで選択可能
    </div>

    <input type="text" id="calendar" name="calendar" value="{{ $currentDate }}" wire:change="getDate($event.target.value)" class="block mt-4 mx-auto">

    <div class="flex border border-gray-600 mt-4 mx-auto">
        <x-calendar-time />
        @for ($i = 0; $i < 7; $i++)
            <div class="w-32">
            <div class="py-1 px-2 border border-gray-300 text-center">{{ $currentWeek[$i]['day'] }}</div>
            <div class="py-1 px-2 border border-gray-300 text-center">{{ $currentWeek[$i]['dayOfWeek'] }}</div>
                @for ($j = 0; $j < 19; $j++)
                    {{-- @if ($reserves->isNotEmpty()) --}}
                        @php
                            $time = \Carbon\CarbonImmutable::createFromFormat('H:i:s', \Constant::RESERVE_TIME[$j])->format('H:i:s');
                        @endphp
                        @if (!is_null($reserves->firstWhere('start_date', $currentWeek[$i]['checkDay'] . " " . $time)))
                            @php
                                $reserveId = $reserves->firstWhere('start_date', $currentWeek[$i]['checkDay'] . " " . $time)->id;
                                $reserveName = $reserves->firstWhere('start_date', $currentWeek[$i]['checkDay'] . " " . $time)->name;
                                $reserveInfo = $reserves->firstWhere('start_date', $currentWeek[$i]['checkDay'] . " " . $time);
                                $reservePeriod = \Carbon\Carbon::parse($reserveInfo->start_date)->diffInMinutes($reserveInfo->end_date) / 30 - 1;
                            @endphp
                            <div class="py-1 px-2 h-8 border border-gray-300 text-black-400 text-center bg-gray-200">
                                {{ $reserveName }}
                            </div>
                            @if ($reservePeriod > 0)
                                @for ($k = 0; $k < $reservePeriod; $k++)
                                    <div class="py-1 px-2 h-8 border border-gray-300 text-center bg-gray-200"></div>
                                @endfor
                                @php
                                    $j += $reservePeriod
                                @endphp
                            @endif
                        @else
                            <div class="py-1 px-2 h-8 border border-gray-300 text-center">
                                <button onclick="location.href='{{ route('admin.reserve.create', ['day' => $currentWeek[$i]['day'], 'time' => $time]) }}'" class="text-red-400">◎</button>
                            </div>
                        @endif
                    {{-- @else
                        <div class="py-1 px-2 h-8 border border-gray-300 text-center">-</div>
                    @endif --}}
                @endfor
            </div>
        @endfor
    </div>

    <div class="flex justify-center">
        <button type="button" onclick="location.href='{{ route('admin.reserve.select-menu') }}'" class="text-gray bg-gray-300 border-0 mt-8 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
    </div>

</div>


