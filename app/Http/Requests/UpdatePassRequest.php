<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassRequest extends FormRequest
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
            // 'current_password'      => 'required',
            'new_password'          => 'required',
            'new_confirm_password'  => 'required|same:new_password'
        ];
    }
    public function messages(){
        return [
            // 'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới',
            'new_confirm_password.required' => 'Vui lòng nhập lại mật khẩu mới',
            'new_confirm_password.same' => 'Nhập lại mật khẩu mới không chính xác'
        ];  
    }
}
