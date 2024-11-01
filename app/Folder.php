<?php

namespace App;

// Eroquentでモデルを作成している為、コントローラーでもEroquentのメソッドを利用できる
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    //tasksメソッド追加(TaskController.phpで利用)
    public function tasks(){
        // Folderモデル(foldersテーブル)とTaskモデル(tasksテーブル)で1対多の関係にする
        return $this -> hasMany('App\Task');
    }
}
