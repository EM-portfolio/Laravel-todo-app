<?php
// このクラスはフォルダ作成時のバリデート担当する

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateFolder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *ユーザーがこのリクエストを行う権限があるかどうかを判断する。

     * @return bool
     */
    // 全てのユーザーにリクエスト権限を渡す
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *  リクエストに適用されるバリデーションルールを取得します。
     *
     * @return array
     */
    // 
    public function rules()
    {
        return [
            'title' => 'required|max:20',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'フォルダ名',
        ];
    }
}
