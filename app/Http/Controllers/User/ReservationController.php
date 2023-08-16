<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reserve; //Eloquent
use App\Models\Stylist;
use App\Models\Menu;
use Illuminate\Support\Facades\DB; //QueryBuilder
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

// "php artisan make:model Reserve -a"で最初からあったuse
use App\Http\Requests\StoreReserveRequest;
use App\Http\Requests\UpdateReserveRequest;
// use App\Models\Reserve;

class ReservationController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $reserves = DB::table('reserves')
        ->whereDate('start_date', '>', $today)
        ->orderBy('start_date', 'asc')
        ->paginate(10);

        return view('user.reservation.index', compact('reserves'));
    }

    public function create(Request $request)
    {
        $data = session()->get('data');
        $menuId = $data['menuId'];
        $stylistId = $data['stylistId'];

        $user = User::findOrFail(Auth::id());
        // $stylists = Stylist::select('id', 'name')->get();
        // $menus = Menu::select('id', 'title', 'content', 'price')->get();

        $menu = Menu::findOrFail($menuId);
        $stylist = Stylist::findOrFail($stylistId);
        $requestDay = $request->query('day'); //表示用
        $day = Carbon::createFromFormat('m月d日', $requestDay)->format('Y-m-d'); //DB保存用
        $requestTime = $request->query('time'); //DB保存用
        $time = Carbon::createFromFormat('H:i:s', $requestTime)->format('G時i分'); //表示用

        $data['day'] = $day;
        $data['requestTime'] = $requestTime;
        session()->put('data', $data);

        return view('user.reservation.create', compact('user', 'day', 'requestTime', 'stylist', 'menu'));
    }

    public function store(StoreReserveRequest $request)
    {
        $data = session()->get('data');
        $menuId = $data['menuId'];
        $stylistId = $data['stylistId'];

        // $menu = Menu::findOrFail($request->menu);
        $menu = Menu::findOrFail($menuId);
        $inputTime = $request['start_time'];
        $endTime = Carbon::parse($inputTime);
        $endTime->addHours($menu->menu_hour);
        $endTime->addMinutes($menu->menu_minutes);
        $endTimeString = $endTime->toTimeString();

        $check = DB::table('reserves')
        ->where('stylist', '=', $stylistId)
        ->whereDate('start_date', $request['reserve_date'])
        ->whereTime('end_date', '>', $request['start_time'])
        ->whereTime('start_date', '<', $endTimeString)
        ->exists();

        // $check:重複しているとtrue, していないとfalse
        if($check){
            return redirect()
            ->route('user.reservation.select-menu')
            ->with(['message' => 'この時間帯は既に他の予約が存在します。他の時間を選択してください。', 'status' => 'alert']);
        }

        $start = $request['reserve_date'] . " " . $request['start_time'];
        $startDate = Carbon::createFromFormat('Y-m-d H:i', $start);

        $end = $request['reserve_date'] . " " . $endTimeString;
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $end);

        Reserve::create([
            'name' => $request->name,
            'menu' => $menuId,
            'stylist' => $stylistId,
            'message' => $request->message,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        return redirect()
        ->route('user.reservation.future')
        ->with(['message' => '予約完了', 'status' => 'info']);
    }

    public function show(Reserve $reservation)
    {
        $reserve = Reserve::findOrFail($reservation->id);
        $reserveDate = $reserve->reserveDate;
        $startTime = $reserve->startTime;
        $endTime = $reserve->endTime;

        $menu = Menu::findOrFail($reserve->menu);

        return view('user.reservation.show',
        compact('reserve', 'menu', 'reserveDate', 'startTime', 'endTime'));
    }

    public function edit(Reserve $reservation)
    {
        $reserve = Reserve::findOrFail($reservation->id);
        $stylists = Stylist::select('id', 'name')->get();
        $menus = Menu::select('id', 'title', 'content', 'price')->get();

        $today = Carbon::today()->format('Y年m月d日');
        if($reserve->reserveDate < $today){
            return abort(404);
        }

        $reserveDate = $reserve->editReserveDate;
        $startTime = $reserve->startTime;
        $endTime = $reserve->endTime;

        return view('user.reservation.edit',
        compact('reserve', 'stylists', 'menus', 'reserveDate', 'startTime', 'endTime'));
    }

    public function update(UpdateReserveRequest $request, Reserve $reservation)
    {
        $menu = Menu::findOrFail($request->menu);
        $inputTime = $request['start_time'];
        $endTime = Carbon::parse($inputTime);
        $endTime->addHours($menu->menu_hour);
        $endTime->addMinutes($menu->menu_minutes);
        $endTimeString = $endTime->toTimeString();

        $check = DB::table('reserves')
        ->whereDate('start_date', $request['reserve_date'])
        ->whereTime('end_date', '>', $request['start_time'])
        ->whereTime('start_date', '<', $endTimeString)
        ->count();

        if($check > 1){
            $reserve = Reserve::findOrFail($reservation->id);
            $reserveDate = $reserve->editReserveDate;
            $startTime = $reserve->startTime;
            $endTime = $reserve->endTime;
            return view('user.reservation.edit', compact('reserve', 'reserveDate', 'startTime', 'endTime'));
        }

        $start = $request['reserve_date'] . " " . $request['start_time'];
        $startDate = Carbon::createFromFormat('Y-m-d H:i', $start);

        $end = $request['reserve_date'] . " " . $endTimeString;
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $end);

        $reserve = Reserve::findOrFail($reservation->id);
        $reserve->name = $request->name;
        $reserve->menu = $request->menu;
        $reserve->stylist = $request->stylist;
        $reserve->message = $request->message;
        $reserve->start_date = $startDate;
        $reserve->end_date = $endDate;
        $reserve->save();

        return redirect()
        ->route('user.reservation.future')
        ->with(['message' => '変更完了', 'status' => 'info']);
    }

    public function selectMenu()
    {
        $stylists = Stylist::select('id', 'name')->get();
        $menus = Menu::select('id', 'title', 'content', 'price', 'menu_hour', 'menu_minutes')->get();

        return view('user.reservation.select-menu', compact('stylists', 'menus'));
    }

    public function selectCalendar(Request $request)
    {
        $menuId = $request->menuId;
        $stylistId = $request->stylistId;

        $data = [
            'menuId' => $menuId,
            'stylistId' => $stylistId,
        ];
        session()->put('data', $data);

        return view('user.reservation.select-calendar', compact('menuId', 'stylistId'));
    }

    public function future()
    {
        $user = User::findOrFail(Auth::id());
        $userName = $user->name;
        $today = Carbon::today();

        $reserves = DB::table('reserves')
        ->join('menus', 'reserves.menu', "=", "menus.id")
        ->where('name', '=', $userName)
        ->whereDate('start_date', '>=', $today)
        ->orderBy('start_date', 'desc')
        ->select('reserves.id', 'reserves.start_date', 'menus.title', 'reserves.message')
        ->paginate(10);

        return view('user.reservation.future', compact('reserves'));
    }

    public function past()
    {
        $today = Carbon::today();

        $reserves = DB::table('reserves')
        ->whereDate('start_date', '<', $today)
        ->orderBy('start_date', 'desc')
        ->paginate(10);

        return view('user.reservation.past', compact('reserves'));
    }

    public function detail($id)
    {
        $reserve = Reserve::findOrFail($id);
        $reserveDate = $reserve->reserveDate;
        $startTime = $reserve->startTime;
        $endTime = $reserve->endTime;

        return view('user.reservation.show',
        compact('reserve', 'reserveDate', 'startTime', 'endTime'));
    }

    public function destroy(Reserve $reservation)
    {
        Reserve::findOrFail($reservation->id)->delete();

        return redirect()
        ->route('user.reservation.future')
        ->with(['message' => 'キャンセルしました', 'status' => 'alert']);
    }
}
