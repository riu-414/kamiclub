<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Stylist;

class MenusController extends Controller
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
        $menus = Menu::select('id', 'title', 'content', 'price')->get();

        return view('admin.menu.index' ,
        compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->title, $request->content, $request->price);

        $request->validate([
            'title' => ['required', 'max:50'],
            'content' => ['required', 'max:200'],
            'price' => ['required', 'max:50'],
        ]);

        Menu::create([
            'title' => $request->title,
            'content' => $request->content,
            'price' => $request->price,
        ]);

        return redirect()
        ->route('admin.menu.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::findOrFail($id);
        $title = $menu->title;
        $content = $menu->content;
        $price = $menu->price;

        return view('admin.menu.show',
        compact('menu'));
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
