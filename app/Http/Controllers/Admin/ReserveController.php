<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reserve; //Eloquent
use App\Models\Stylist;
use App\Models\Menu;
use Illuminate\Support\Facades\DB; //QueryBuilder
use Carbon\Carbon;

// "php artisan make:model Reserve -a"で最初からあったuse
use App\Http\Requests\StoreReserveRequest;
use App\Http\Requests\UpdateReserveRequest;
// use App\Models\Reserve;


class ReserveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $today = Carbon::today();

        $reserves = DB::table('reserves')
        ->whereDate('start_date', '>', $today)
        ->orderBy('start_date', 'asc')
        ->paginate(10);

        return view('admin.reserve.index' , compact('reserves'));
    }

    public function create()
    {
        $stylists = Stylist::select('id', 'name')->get();
        $menus = Menu::select('id', 'title', 'content', 'price')->get();

        return view('admin.reserve.create', compact('stylists', 'menus'));
    }

    public function store(StoreReserveRequest $request)
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
        ->exists();

        if($check){
            return redirect()
            ->route('admin.reserve.create')
            ->with(['message' => 'この時間帯は既に他の予約が存在します。', 'status' => 'alert']);
        }

        $start = $request['reserve_date'] . " " . $request['start_time'];
        $startDate = Carbon::createFromFormat('Y-m-d H:i', $start);

        $end = $request['reserve_date'] . " " . $endTimeString;
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $end);

        // 1時間後
        // $dt = new Carbon('2018-08-08 09:05:53');
        // echo $dt->addHour();

        // 指定分後
        // $dt = new Carbon('2018-08-08 09:05:53');
        // echo $dt->addMinute(指定分);

        Reserve::create([
            'name' => $request->name,
            'menu' => $request->menu,
            'stylist' => $request->stylist,
            'message' => $request->message,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        return redirect()
        ->route('admin.reserve.index')
        ->with(['message' => '予約完了', 'status' => 'info']);
    }

    public function show(Reserve $reserve)
    {
        $reserve = Reserve::findOrFail($reserve->id);
        $reserveDate = $reserve->reserveDate;
        $startTime = $reserve->startTime;
        $endTime = $reserve->endTime;

        return view('admin.reserve.show',
        compact('reserve', 'reserveDate', 'startTime', 'endTime'));
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

        $inputTime = $request['start_time'];
        $endTime = Carbon::parse($inputTime);
        $endTime->addHour();
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
        ->route('admin.reserve.index')
        ->with(['message' => 'キャンセルしました', 'status' => 'alert']);
    }
}
