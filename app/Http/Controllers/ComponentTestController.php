<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentTestController extends Controller
{
    //
    public function showComponent1()
    {
        return view('tests.component-test1'); // view('フォルダ名.ファイル名')
    }

    public function showComponent2()
    {
        return view('tests.component-test2');
    }
}
