<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        //現在ログインしているユーザーの情報を取得する
        $user = Auth::user();

        //現在ログインしているユーザーのフォルダーの１行目の情報を取得
        $folder = $user->folders()->first();

        //フォルダーの情報が無かったらフォルダ作成画面へ遷移する
        if(is_null($folder)){
            // Views/home.blade.phpを表示する
            return view('home');
        }
        //フォルダがあったらidを取得し、tasks/indexにidを渡す。
        return redirect()->route('tasks.index',[
            'id' => $folder -> id,
        ]);


    }
}
