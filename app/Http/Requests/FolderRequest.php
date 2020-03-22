<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FolderRequest extends FormRequest
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
            'name' => 'required|string|max:10',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => '名前を入力して下さい。',
            'name.string'     => '名前は文字列で入力して下さい。',
            'name.max'     => '名前の可能文字数は10字以内です。',
        ];
    }
}
