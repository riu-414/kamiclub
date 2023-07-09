<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Stylist; //Eloquent
use Illuminate\Support\Facades\DB; //QueryBuilder
use NunoMaduro\Collision\Adapters\Phpunit\Style;

class StylistController extends Controller
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
        $stylists = Stylist::select('id', 'name', 'created_at')->get();

        // echo $stylists;

        return view('admin.stylist.index' ,
        compact('stylists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.stylist.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Admin::class],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        Stylist::create([
            'name' => $request->name,
            // 'email' => $request->email,
            // 'password' => Hash::make($request->password),
        ]);

        return redirect()
        ->route('admin.stylist.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $stylist = Stylist::findOrFail($id);
        // dd($stylist);
        return view('admin.stylist.edit', compact('stylist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $stylist = Stylist::findOrFail($id);
        $stylist->name = $request->name;
        $stylist->save();

        return redirect()
        ->route('admin.stylist.index')
        ->with(['message' => 'スタイリスト情報を更新', 'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Stylist::findOrFail($id)->delete(); //ソフトデリート

        return redirect()
        ->route('admin.stylist.index')
        ->with(['message' => 'スタイリスト情報を削除', 'status' => 'alert']);
    }
}
