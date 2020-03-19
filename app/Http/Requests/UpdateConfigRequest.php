<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConfigRequest extends FormRequest
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
            'website_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'time' => 'required',
            'logo' => 'nullable|file|image|mimes:jpg,png,jpeg'
        ];
    }

    public function messages()
    {
        return [
            'website_name.required' => 'Vui lòng nhập tên website',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'logo.file' => 'Hình ảnh không hợp lệ',
            'logo.image' => 'Hình ảnh không hợp lệ',
            'logo.mimes' => 'Hình ảnh không hợp lệ',
            'time.required' => 'Vui lòng nhập thời gian làm việc'
        ];
    }
}
