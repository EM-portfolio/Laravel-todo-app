<?php
// このコントローラーは、todoアプリのフォルダ新規作成用ページの表示と、フォルダ作成を処理する
namespace App\Http\Controllers;

use App\Folder;
use App\Http\Requests\CreateFolder; // バリデーション用
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    // view側の設定(フォルダー作成ページ用)
    public function showCreateForm(){
        return view('folders/create');
    }
    
    // フォルダ作成処理
    // 引数にはメソッドが必要とするrequestデータを渡す
    public function create(CreateFolder $request){ //バリデートとリクエスト機能の追加
        
        // folderモデル(folderクラスの)のインスタンスを作成することで、新しくレコードを追加出来る
        $folder = new Folder();

        // 多分追加必要かも????
        // $folder->user_id = Auth::id();
        

        // フォームから入力された値が$request(input type name="title")の中のtitleに入ってる。
        $folder->title = $request->title;

        // ユーザーを紐づける
        //Auth::user...認証されているユーザー
        //userモデル内のfoldersの内容を引っ張ってきて、$folderを保存する
        Auth::user()->folders()->save($folder);


        // $user = Auth::user();
        // Folder::updateOrCreate(
        //     ['id' => null],
        //     [
        //         'user_id' => $user->id,
        //         'title' => $request->title,
        //     ]
        // );

        // オブジェクトの状態をDBに反映させる
        // $folder -> save();

        // rediretorのrouteメソッドを利用してリダイレクトさせる。
        return redirect()->route('tasks.index', ['id' => $folder->id,]);
        // return redirect(route('tasks.index', ['id' => $folder->id,]));


    }

}
// この上記のコードはフォルダーが作成される際に実行されるcreateメソッドです。
// 新しいフォルダーが作成された時、新しいfolderレコードを作成し、
// リクエストで送信されてきた単語を$folderの中のタイトルに代入し、
// その内容を Auth::user()->folders->save($folder)で
// 認証されているユーザーを特定し、ユーザーモデル内で紐づけられているfoldersを呼び出し、
// $folder->titleで保存されている内容をユーザー情報と一緒にテーブルに保存する
