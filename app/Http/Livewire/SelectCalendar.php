<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\CarbonImmutable;
use App\Services\ReserveService;
use App\Models\Holiday;
use App\Models\Menu;
use App\Services\HolidayService;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\Reserve;

class SelectCalendar extends Component
{

    public $currentDate;
    public $currentWeek;
    public $day;
    public $checkDay;
    public $dayOfWeek;
    public $sevenDaysLater;
    public $reserves;
    public $holidays;
    public $menu;

    public function mount()
    {
        $data = session()->get('data');
        $stylistId = $data['stylistId'];
        $menuId = $data['menuId'];

        $this->currentDate = CarbonImmutable::today();
        $this->sevenDaysLater = $this->currentDate->addDays(7);
        $this->currentWeek = [];

        $this->reserves = ReserveService::getWeekReserves(
            $this->currentDate->format('Y-m-d'),
            $this->sevenDaysLater->format('Y-m-d'),
            $stylistId,
        );

        $this->holidays = HolidayService::getWeekHolidays();

        $this->menu = Menu::find($menuId);

        // dd($menu->menu_hour, $menu->menu_minutes);

        for($i = 0; $i < 7; $i++){
            $this->day = CarbonImmutable::today()->addDays($i)->format('m月d日');
            $this->checkDay = CarbonImmutable::today()->addDays($i)->format('Y-m-d');
            $this->dayOfWeek = CarbonImmutable::today()->addDays($i)->dayName;
            array_push($this->currentWeek, [
                'day' => $this->day,
                'checkDay' => $this->checkDay,
                'dayOfWeek' => $this->dayOfWeek
            ]);
        }

    }

    public function getDate($date)
    {
        $data = session()->get('data');
        $stylistId = $data['stylistId'];

        $this->currentDate = $date;
        $this->currentWeek = [];
        $this->sevenDaysLater = CarbonImmutable::parse($this->currentDate)->addDays(7);

        $this->reserves = ReserveService::getWeekReserves(
            $this->currentDate,
            $this->sevenDaysLater->format('Y-m-d'),
            $stylistId,
        );

        $this->holidays = HolidayService::getWeekHolidays();

        for($i = 0; $i < 7; $i++){
            $this->day = CarbonImmutable::parse($this->currentDate)->addDays($i)->format('m月d日');
            $this->checkDay = CarbonImmutable::parse($this->currentDate)->addDays($i)->format('Y-m-d');
            $this->dayOfWeek = CarbonImmutable::parse($this->currentDate)->addDays($i)->dayName;
            array_push($this->currentWeek, [
                'day' => $this->day,
                'checkDay' => $this->checkDay,
                'dayOfWeek' => $this->dayOfWeek
            ]);
        }
    }

    public function render()
    {
        return view('livewire.select-calendar');
    }
}
