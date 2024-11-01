<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Task extends Model
{
    /**
     * アクセサ
     * 状態定義(constで定数を定義する)
     * ※laravelのアクセサはモデルのインスタンスが存在すれば、どこからでもアクセス可
     */
    const STATUS = [
        1 => ['label' => '未着手', 'class' => 'label-danger'],
        2 => ['label' => '着手中', 'class' => 'label-info'],
        3 => ['label' => '完了', 'class' => ''],
    ];

    /**
     * 状態のラベル
     * @return string
     */
    // アクセスするときはtask -> status_classでアクセスする。(get<アクセサ_名>Attribute)
    // model -> アクセサ_名
    public function getStatusLabelAttribute(){

        // tasksテーブルのstatusカラムに値があったら、その値1,2,3のいずれかを取得
        $status = $this -> attributes['status'];

        // 上記コードで値を取得できなかった場合には空文字を返す(1,2,3以外の場合)
        // memo) self::STATUSはこのクラス自体からSTATUSを参照している
        if(!isset(self::STATUS[$status])){ 
            return '';
        }
        
        // STATUS[$status]['label']で(未着手/着手中/完了)を取得し、値を返す。
        return self::STATUS[$status]['label'];
     }

     // class名取得用アクセサ
     public function getStatusClassAttribute(){

        $status = $this -> attributes['status'];

        if(!isset(self::STATUS[$status])){ 
            return '';
        }

        return self::STATUS[$status]['class'];
     }

     // 整形した期限日(due-date)
     public function getFormattedDueDateAttribute(){
         // carbonでdue-dateカラムのデータをy-m-dとして解析し、formatでy/m/dに直している
         // Carbon::createFromFormat()メソッドは、第一引数に指定した形式の文字列を日付として解析
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date']) -> format('Y/m/d');
     }






}
