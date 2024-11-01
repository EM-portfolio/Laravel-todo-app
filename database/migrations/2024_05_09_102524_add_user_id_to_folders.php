<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToFolders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // folders テーブルに対する操作を定義
        Schema::table('folders', function (Blueprint $table) {
            $table -> integer('user_id') -> unsigned(); 
            // 【SQL】alter table "folders" add column "user_id" integer not null
            // foldersテーブルに新しい"user_id"列を整数型で、NotNull制約を付け、追加する。
            $table -> foreign('user_id') -> references('id') -> on('users');
            // 【SQL】alter table "folders" add constraint "folders_user_id_foreign" foreign key ("user_id") references "users" ("id")
            // 既存のテーブルfoldersのuser_id列とusersテーブルのid列をリンクさせる。そのリンク制約の名前をfolders_use_id_foreignと呼ぶ

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('folders', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
