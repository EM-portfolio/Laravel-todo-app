<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTask extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *  ユーザーがこのリクエストを行う権限があるかどうかを判断する。
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * リクエストに適用されるバリデーションルールを取得します。
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100', // 必須：タスク名はtitleで、max100文字
            'due_date' => 'required|date|after_or_equal:today', // 必須：日付｜日付が今日以降
        ];
    }
    // 属性名の変更(formから入力された時のid名。エラーメッセージで表示させる変更)
    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'due_date' => '期限日',
        ];
    }

    // エラーメッセージのカスタマイズ
    public function messages()
    {
        // 今日以前の日付ではなかった場合のバリデーション
        return [
            //'due_date.date' => '期限日 には日付を入力してください。',
            'due_date.after_or_equal' => ':attribute には今日以降の日付を入力してください。',
        ];
    }
}
