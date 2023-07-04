<div>
    カレンダー

    <input type="text" id="calendar" name="calendar" value="{{ $currentDate }}" wire:change="getDate($event.target.value)" class="block mt-1">

    <div class="flex">
        @for ($day = 0; $day < 7; $day++)
            {{ $currentWeek[$day] }}
        @endfor
    </div>

    @foreach ($reserves as $reserve)
        {{ $reserve->start_date }}<br>
    @endforeach

</div>


