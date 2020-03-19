<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSliderRequest extends FormRequest
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
            'url_slider' => 'required|image|max:2048|mimes:jpeg,jpg,png',
        ];
    }
    public function messages(){
        return [
            'url_slider.required' => 'Chưa chọn hình ảnh trình chiếu',
            'url_slider.image' => 'File tải lên không phải là định dạng hình ảnh',
            'url_slider.max' => 'Dung lượng của hình ảnh lớn nhất là 2MB',
            'url_slider.mimes' => 'Hình ảnh tải lên phải có định dạng là jpeg, jpg hoặc png'
        ];
    }
}
