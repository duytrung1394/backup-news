<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SlideRequest extends FormRequest
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
            //
            'txtTen'       => 'required|min:10|max:200',
            'txtNoiDung'   => 'required',
            'txtLink'      => 'required',
            'Hinh'         => 'required',
        ];
    }

    public function messages()
    {
        return [
            'txtTen.required'    => "Bạn chưa nhập vào tên slide",
            'txtTen.min'         => "Tên có độ dài từ 10 đến 200 kí tự",
            'txtTen.max'         => "Tên có độ dài từ 10 đến 200 kí tự",
            'txtNoiDung.required'=> "Bạn chưa nhập vào Nội dung",
            'txtLink.required'   => "Bạn chưa nhập vào đường dẫn",
            'Hinh.required'      => "Bạn chưa chọn hình",   
        ];
    }
}
