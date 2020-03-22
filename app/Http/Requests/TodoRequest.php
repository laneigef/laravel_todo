<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:50',
            'task_statuses_id' => 'required|numeric',
            'detail' => 'nullable|string|max:250',
            'deadline' => 'nullable|date_format:"Y-m-d"',
        ];
    }

    public function messages()
    {
        return [
            'title.required'     => 'タイトルを入力して下さい。',
            'title.string'     => 'タイトルは文字列で入力して下さい。',
            'title.max'     => 'タイトルの可能文字数は50字以内です。',
            'task_statuses_id.required'   => 'フォルダを選択して下さい。',
            'task_statuses_id.numeric'   => '正しい選択肢を選択して下さい。',
            'detail.string'     => '詳細は文字列で入力して下さい。',
            'detail.max'     => '詳細の可能文字数は250字以内です。',
            'deadline.date_format'     => '対応期限は正しいフォーマットで入力してください。',
        ];
    }
}
