<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reserve; //Eloquent
use App\Models\Stylist;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\DB; //QueryBuilder
use Carbon\Carbon;
use Illuminate\Http\Request;

// "php artisan make:model Reserve -a"で最初からあったuse
use App\Http\Requests\StoreReserveRequest;
use App\Http\Requests\UpdateReserveRequest;
use App\Http\Requests\CreateReserveRequest;
// use App\Models\Reserve;


class ReserveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $stylistId = $request->stylistId;

        $data = [
            'stylistId' => $stylistId,
        ];
        session()->put('data', $data);

        $today = Carbon::today();

        $reserves = DB::table('reserves')
        ->whereDate('start_date', '>', $today)
        ->orderBy('start_date', 'asc')
        ->paginate(10);

        return view('admin.reserve.index' , compact('reserves', 'stylistId'));
    }

    public function create(Request $request)
    {
        $data = session()->get('data');
        $menuId = $data['menuId'];
        $stylistId = $data['stylistId'];

        $menu = Menu::findOrFail($menuId);
        $stylist = Stylist::findOrFail($stylistId);
        $requestDay = $request->query('day'); //表示用
        $day = Carbon::createFromFormat('m月d日', $requestDay)->format('Y-m-d'); //DB保存用
        $requestTime = $request->query('time'); //DB保存用
        $time = Carbon::createFromFormat('H:i:s', $requestTime)->format('G時i分'); //表示用

        $data['day'] = $day;
        $data['requestTime'] = $requestTime;
        session()->put('data', $data);

        return view('admin.reserve.create', compact('day', 'requestTime', 'stylist', 'menu'));
    }

    public function store(StoreReserveRequest $request)
    {
        $data = session()->get('data');
        $menuId = $data['menuId'];
        $stylistId = $data['stylistId'];

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

        // dd($check);

        // true重複する。false重複しない
        if($check){
            return redirect()
            // ->route('admin.reserve.create')
            ->route('admin.dashboard')
            ->with(['message' => 'この時間帯は既に他の予約が存在します。別の時間を指定してください。', 'status' => 'alert']);
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
        // ->route('admin.reserve.index')
        ->route('admin.dashboard')
        ->with(['message' => '予約完了', 'status' => 'info']);
    }

    public function show(Reserve $reserve)
    {
        $reserve = Reserve::findOrFail($reserve->id);
        $reserveDate = $reserve->reserveDate;
        $startTime = $reserve->startTime;
        $endTime = $reserve->endTime;

        $menu = Menu::findOrFail($reserve->menu);
        $stylist = Stylist::findOrFail($reserve->stylist);

        return view('admin.reserve.show',
        compact('reserve', 'reserveDate', 'startTime', 'endTime', 'menu', 'stylist'));
    }

    public function edit(Reserve $reserve)
    {
        $reserve = Reserve::findOrFail($reserve->id);
        $menus = Menu::select('id', 'title', 'content', 'price')->get();
        $stylists = Stylist::select('id', 'name')->get();

        $today = Carbon::today()->format('Y年m月d日');
        if($reserve->reserveDate < $today){
            return abort(404);
        }

        $reserveDate = $reserve->editReserveDate;
        $startTime = $reserve->startTime;
        $endTime = $reserve->endTime;

        return view('admin.reserve.edit',
        compact('reserve', 'menus', 'stylists', 'reserveDate', 'startTime', 'endTime'));
    }

    public function update(UpdateReserveRequest $request, Reserve $reserve)
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
            $reserve = Reserve::findOrFail($reserve->id);
            $reserveDate = $reserve->editReserveDate;
            $startTime = $reserve->startTime;
            $endTime = $reserve->endTime;
            return view('admin.reserve.edit', compact('reserve', 'reserveDate', 'startTime', 'endTime'));
        }

        $start = $request['reserve_date'] . " " . $request['start_time'];
        $startDate = Carbon::createFromFormat('Y-m-d H:i', $start);

        $end = $request['reserve_date'] . " " . $endTimeString;
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $end);

        $reserve = Reserve::findOrFail($reserve->id);
        $reserve->name = $request->name;
        $reserve->menu = $request->menu;
        $reserve->stylist = $request->stylist;
        $reserve->message = $request->message;
        $reserve->start_date = $startDate;
        $reserve->end_date = $endDate;

        $reserve->save();

        return redirect()
        ->route('admin.reserve.index')
        ->with(['message' => '変更完了', 'status' => 'info']);
    }

    public function selectMenu()
    {
        $stylists = Stylist::select('id', 'name')->get();
        $menus = Menu::select('id', 'title', 'content', 'price', 'menu_hour', 'menu_minutes')->get();

        return view('admin.reserve.select-menu', compact('stylists', 'menus'));
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

        return view('admin.reserve.select-calendar', compact('menuId', 'stylistId'));
    }

    public function past()
    {
        $today = Carbon::today();

        $reserves = DB::table('reserves')
        ->whereDate('start_date', '<', $today)
        ->orderBy('start_date', 'desc')
        ->paginate(10);

        return view('admin.reserve.past', compact('reserves'));
    }

    public function detail($id)
    {
        $reserve = Reserve::findOrFail($id);
        $reserveDate = $reserve->reserveDate;
        $startTime = $reserve->startTime;
        $endTime = $reserve->endTime;

        return view('admin.reserve.show',
        compact('reserve', 'reserveDate', 'startTime', 'endTime'));
    }

    public function destroy(Reserve $reserve)
    {
        Reserve::findOrFail($reserve->id)->delete();

        return redirect()
        // ->route('admin.reserve.index')
        ->route('admin.dashboard')
        ->with(['message' => 'キャンセルしました', 'status' => 'alert']);
    }
}
