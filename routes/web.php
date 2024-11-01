<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//testがルート viewはviewフォルダのファイル名を指定
// Route::get('/test', function () {
//     return view('no_con_test_file');
// });

// ルートsamplepostを　Http/controllers/StestampleControlle4r.phpから呼び出す
Route::get('samplepost', 'StestampleControlle4r@test');


/*
|--------------------------------------------------------------------------
| todoapp作成
|--------------------------------------------------------------------------
|
|
*/
// 既に認証しているユーザーが認証が必要なページにアクセスした場合の処理
// middleware：リクエスト後、ブラウザ表示前の処理
// authミドルウェアを適用するルートグループ
Route::group(['middleware' => 'auth'], function(){ // 保護をかけたいページにauthを使う

    //トップページへのアクセス
    Route::get('/', 'HomeController@index')->name('home');

    //todo:フォルダ作成ページを表示(getでアクセスされた場合(a要素クリック)はフォルダ作成ページを表示させる)
    Route::get('/folders/create', 'FolderController@showCreateForm') -> name('folders.create');

    //todo:フォルダ作成処理を実行(上記のコードでフォルダを作成された後の処理を実行する,もしくはpostでアクセスされた時に処理をする)
    Route::post('/folders/create', 'FolderController@create');

    //folderに対するview権限を持っているユーザーのみが、このグループ内のルートにアクセスできる
    // can:[policy関数名], 対象(※view権限を持っているユーザーのみがアクセスできる)
    Route::group(['middleware' => 'can:view,folder'], function() {
        // todoapp({id}はクエリ文字が入る)：編集済み(id⇒folder)
        Route::get('/folders/{folder}/tasks', 'TaskController@index') -> name('tasks.index');

        //todo:タスクの新規作成
        Route::get('/folders/{folder}/tasks/create', 'TaskController@showCreateForm') -> name('tasks.create');
        Route::post('/folders/{folder}/tasks/create', 'TaskController@create');

        //タスク編集機能の追加
        Route::get('/folders/{folder}/tasks/{task}/edit', 'TaskController@showEditForm') -> name('tasks.edit');
        Route::post('folders/{folder}/tasks/{task}/edit', 'TaskController@edit');
    });

    // 例外500ページを表示
    Route::get('/test-error', function () {
        abort(500);
    });
    
});



//認証ルートを登録(認証機能の追加app/Http/Controllers/Auth)
// 以下一行で登録/ログイン/ログアウト/パスワードリセット/パスワードメール送信の実装を簡単にできるやつ
Auth::routes();