<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Holiday;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HolidayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $holidays = Holiday::select('id', 'start_holiday', 'end_holiday')
        ->orderBy('start_holiday', 'desc')
        ->get();

        return view('admin.holiday.index', compact('holidays'));
    }

    public function create()
    {
        return view('admin.holiday.create');
    }

    public function store(Request $request)
    {
        $check = DB::table('holidays')
        ->whereDate('start_holiday', $request->holiday)
        ->exists();

        // true重複する。false重複しない
        if($check){
            return redirect()
            ->route('admin.holiday.index')
            ->with(['message' => 'この時間帯は既に他の休日設定されています。', 'status' => 'alert']);
        }

        $start = $request['holiday'] . " " . $request['start_time'];
        $startHoliday = Carbon::createFromFormat('Y-m-d H:i', $start);

        $end = $request['holiday'] . " " . $request['end_time'];
        $endHoliday = Carbon::createFromFormat('Y-m-d H:i', $end);

        Holiday::create([
            'start_holiday' => $startHoliday,
            'end_holiday' => $endHoliday,
        ]);

        return redirect()
        ->route('admin.holiday.index')
        ->with(['message' => '休日設定完了', 'status' => 'info']);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        Holiday::findOrFail($id)->delete();

        return redirect()
        ->route('admin.holiday.index')
        ->with(['message' => '設定した休日を削除', 'status' => 'alert']);
    }
}
