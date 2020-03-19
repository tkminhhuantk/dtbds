<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCommentRequest extends FormRequest
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
            'name' =>'required',
            'email' => 'required',
            'content' => 'required',
            
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Chưa nhập họ và tên',
            'email.required' => 'Chưa nhập email',
            'content.required' => 'Chưa nhập nội dung bình luận'
        ];
    }
}
