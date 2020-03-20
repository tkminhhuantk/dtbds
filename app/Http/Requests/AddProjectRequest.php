<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProjectRequest extends FormRequest
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
            'title' =>'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'slug' => 'required|unique:projects',
            'address' => 'required',
            'price' => 'required',
            'acreage' => 'required',
            'url_images' => 'required',
            'url_images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
    public function messages(){
        return [
            'title.required' => 'Tiêu đề là trường bắt buộc',
            'avatar.required' => 'Hình đại diện là bắt buộc', 
            'avatar.image' => 'File upload không phải hình ảnh', 
            'avatar.mimes' => 'Hình ảnh upload có định dạng là jpeg, png hoặc jpg', 
            'avatar.max' => 'Dung lượng hình ảnh upload là 2 MB', 
            'address.required' => 'Địa chỉ là trường bắt buộc',
            'slug.required' => 'Vui lòng nhập slug',
            'slug.unique' => 'Slug đã được sử dụng',
            'price.required' => 'Chưa nhập giá dự án',
            'acreage.required' => 'Chưa nhập diện tích',
            'url_images.required' => 'Hình ảnh không được để trống',
            'url_images.*.image' => 'Hình ảnh upload phải là file hình',
            'url_images.*.mimes' => 'Hình ảnh upload có định dạng là jpeg, png hoặc jpg',
            'url_images.*.max' => 'Dung lượng hình ảnh upload là 2MB'
        ];  
    }
}
