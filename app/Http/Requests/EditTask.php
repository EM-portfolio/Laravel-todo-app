<?php


namespace App\Http\Requests;

use App\Task;
use Illuminate\Validation\Rule;

class EditTask extends CreateTask
{

    public function rules()
    {
        //親クラスCreateTaskのrulesメソッドを呼び出し代入
        $rule = parent::rules();

        // ##### $ruleの中身
        // => [
        //     "title" => "required|max:100",
        //     "due_date" => "required|date|after_or_equal:today",
        //   ]


        //未着手/着手/完了の状態のみを通す
        $status_rule = Rule::in(array_keys(Task::STATUS));
        // $status_rule = Rule::in(['未着手', '着手', '完了']);
        // in:"未着手","着手","完了"

        return $rule + ['status' => 'required|' . $status_rule,];

        // ##### returnの中身
        // >>> $test = $rule + ['status' => 'required|' . $status_rule,];
        // => [
        //     "title" => "required|max:100",
        //     "due_date" => "required|date|after_or_equal:today",
        //★★★"status" => "required|in:'未着手', '着手', '完了'",★★★
        // ]
    }

    public function attributes()
    {
        //親クラスCreateTaskのattributesメソッドを呼び出し代入
        $attributes = parent::attributes();

        return $attributes + [
            'status' => '状態',
        ];

        // >>> $attributes + ['status' => 'jotai'];
        // => [
        // "title" => "タイトル",
        // "due_date" => "期限日",
        // "status" => "jotai",
    }

    public function messages()
    {
        //親クラスCreateTaskのmessagesメソッドを呼び出し代入
        $messages = parent::messages();

        //TaskモデルからSTATUSを呼び出し無名関数を実行する。
        $status_labels = array_map(function($item){return $item['label'];}, Task::STATUS);
        // ##### $status_labelsの中身
        // >>> var_dump($status_labels)
        // array(3) {
        // [1]=>
        // string(9) "未着手"
        // [2]=>
        // string(9) "着手中"
        // [3]=>
        // string(6) "完了"
        // }
        
        // 配列の中身を[、]区切りにする
        $status_labels = implode('、', $status_labels);
        // >>> => "未着手、着手中、完了"
        
        //status.inルールは、ユーザーがフォームに入力したstatusフィールドの値が「未着手」、「進行中」、「完了」のいずれかであることを確認するために使用
        return $messages + [
            'status.in' => ':attribute には ' . $status_labels. ' のいずれかを指定してください。',
        ];
        // ##### retrunの中身
        // => [
        //     "due_date.after_or_equal" => ":attribute には今日以降の日付を入力してください。",
        //     "status.in" => ":attribute には未着手、着手中、完了のいずれかを指定してください。",
        //   ]
    }

}
