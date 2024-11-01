<?php

use Carbon\Carbon; // 時間を取得する便利なクラスをインポートしてる
use Illuminate\Database\Seeder; // テストデータを挿入する為のSeeder機能をインポート
use Illuminate\Support\Facades\DB; // DBファザードをインポートしてる


class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // usersテーブルの最初のレコードを取得する
        $user = DB::table('users') -> first();
        // $呼び出した結果 = ファザード::メソッド -> 呼び出し
        // クラスをインスタンス化せずにメソッドを実行可能にする

        //todoアプリにテストデータを３件挿入する
        $titles = ['プライベート', '仕事', '旅行'];

        // foreachを使ってインサートにデータを挿入する
        foreach ($titles as $title) {
            # DBファザードを使ってインサート文を生成する。
            DB::table('folders') -> insert([
                'title' => $title,
                'user_id' => $user -> id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
