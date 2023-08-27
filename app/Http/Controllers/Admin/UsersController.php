<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; //Eloquent
use Carbon\Carbon;

class UsersController extends Controller
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
        $users = User::select('id', 'name', 'created_at')->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $birthday = Carbon::parse($user->birthday)->format('Y年n月j日');
        $createDay = Carbon::parse($user->created_at)->format('Y年n月j日 h時i分s秒');

        // dd($createDay);

        return view('admin.users.show',compact('user', 'birthday', 'createDay'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::findOrFail($id)->delete(); //ソフトデリート

        return redirect()
        ->route('admin.users.index')
        ->with(['message' => 'お客様情報を削除', 'status' => 'alert']);
    }
}
