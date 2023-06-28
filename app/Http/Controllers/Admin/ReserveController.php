<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Reserve; //Eloquent
use Illuminate\Support\Facades\DB; //QueryBuilder
use NunoMaduro\Collision\Adapters\Phpunit\Style;
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
        $reserves = DB::table('reserves')
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
        $check = DB::table('reserves')
        ->whereDate('start_date', $request['reserve_date'])
        ->whereTime('end_date', '>', $request['start_time'])
        ->whereTime('start_date', '<', $request['end_time'])
        ->exists();

        // 重複しているとtrue, していないとfalse
        // dd($check);

        if($check){
            return view('admin.reserve.create');
        }

        $start = $request['reserve_date'] . " " . $request['start_time'];
        $startDate = Carbon::createFromFormat('Y-m-d H:i', $start);

        $end = $request['reserve_date'] . " " . $request['end_time'];
        $endDate = Carbon::createFromFormat('Y-m-d H:i', $end);

        Reserve::create([
            'name' => $request->name,
            'menu' => $request->menu,
            'message' => $request->message,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        return redirect()
        ->route('admin.reserve.index');
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
        //
    }

    public function update(UpdateReserveRequest $request, Reserve $reserve)
    {
        //
    }

    public function destroy(Reserve $reserve)
    {
        //
    }
}
