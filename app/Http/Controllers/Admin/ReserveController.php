<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reserve; //Eloquent
use Illuminate\Support\Facades\DB; //QueryBuilder
use Carbon\Carbon;
use Carbon\CarbonImmutable;

use Illuminate\Http\Request;
use App\Models\Admin;
use NunoMaduro\Collision\Adapters\Phpunit\Style;

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
        return view('admin.reserve.create');
    }

    public function store(StoreReserveRequest $request)
    {
        $inputTime = $request['start_time'];
        $endTime = Carbon::parse($inputTime);
        $endTime->addHour();
        $endTimeString = $endTime->toTimeString();

        $check = DB::table('reserves')
        ->whereDate('start_date', $request['reserve_date'])
        ->whereTime('end_date', '>', $request['start_time'])
        ->whereTime('start_date', '<', $endTimeString)
        ->exists();

        // $check:重複しているとtrue, していないとfalse
        // dd($check, $request['reserve_date'], $inputTime, $endTimeString);

        if($check){
            return view('admin.reserve.create');
        }

        $start = $request['reserve_date'] . " " . $request['start_time'];
        $startDate = Carbon::createFromFormat('Y-m-d H:i', $start);

        $end = $request['reserve_date'] . " " . $endTimeString;
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $end);

        // $end = $request['reserve_date'] . " " . $request['end_time'];
        // $endDate = Carbon::createFromFormat('Y-m-d H:i', $end);

        // 1時間後
        // $dt = new Carbon('2018-08-08 09:05:53');
        // echo $dt->addHour();

        // 指定分後
        // $dt = new Carbon('2018-08-08 09:05:53');
        // echo $dt->addMinute(指定分);

        Reserve::create([
            'name' => $request->name,
            'menu' => $request->menu,
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
        // dd($reserve);

        $reserve = Reserve::findOrFail($reserve->id);
        $reserveDate = $reserve->reserveDate;
        $startTime = $reserve->startTime;
        $endTime = $reserve->endTime;

        // dd($reserveDate, $startTime, $endTime);

        return view('admin.reserve.show',
        compact('reserve', 'reserveDate', 'startTime', 'endTime'));
    }

    public function edit(Reserve $reserve)
    {
        $reserve = Reserve::findOrFail($reserve->id);

        $today = Carbon::today()->format('Y年m月d日');
        if($reserve->reserveDate < $today){
            return abort(404);
        }

        $reserveDate = $reserve->editReserveDate;
        $startTime = $reserve->startTime;
        $endTime = $reserve->endTime;

        return view('admin.reserve.edit',
        compact('reserve', 'reserveDate', 'startTime', 'endTime'));
    }

    public function update(UpdateReserveRequest $request, Reserve $reserve)
    {
        $check = DB::table('reserves')
        ->whereDate('start_date', $request['reserve_date'])
        ->whereTime('end_date', '>', $request['start_time'])
        ->whereTime('start_date', '<', $request['end_time'])
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

        $end = $request['reserve_date'] . " " . $request['end_time'];
        $endDate = Carbon::createFromFormat('Y-m-d H:i', $end);

        $reserve = Reserve::findOrFail($reserve->id);
        $reserve->name = $request->name;
        $reserve->menu = $request->menu;
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
        // dd($reserve);

        $reserve = Reserve::findOrFail($id);
        $reserveDate = $reserve->reserveDate;
        $startTime = $reserve->startTime;
        $endTime = $reserve->endTime;

        // dd($reserveDate, $startTime, $endTime);

        return view('admin.reserve.show',
        compact('reserve', 'reserveDate', 'startTime', 'endTime'));
    }

    public function destroy(Reserve $reserve)
    {
        //
    }
}
