<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StestampleControlle4r extends Controller
{
    //testで実行
    public function test(Request $request){
        return view('test_file');
    }
}
