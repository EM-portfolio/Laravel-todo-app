<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // php artisan migrationコマンド実行時にup()が実行される
    public function up()
    {
        // 新規作成テーブル定義
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id'); // 自動採番id列
            $table->integer('folder_id')->unsigned(); // マイナス値無のid列
            $table->string('title', 100); // タイトル列100文字まで
            $table->date('due_date'); // 期限列
            $table->integer('status')->default(1); // status列 デフォルト値1
            $table->timestamps(); // created_at, updated_at列を作成

            // 外部制約キーを設定する
            $table->foreign('folder_id')->references('id')->on('folders');
            // folder_id列はfoldersテーブルのidを入れる
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // upのロールバックする為のメソッド
    // php artisan migrate:rollbackするときに呼び出される(直前のmigrationをロールバックする)
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
