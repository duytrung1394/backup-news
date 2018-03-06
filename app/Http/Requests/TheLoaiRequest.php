<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TheLoaiRequest extends FormRequest
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
            'Ten'   =>  'required|min:3|max:100'
        ];
    }
    public function messages()
    {
        return  [
            'Ten.required'  =>  "Bạn chưa nhập tên thể loại",               //có 3 thông báo tương ứng với 3 trường
            'Ten.min'       =>  "Bạn phải nhập tên có độ dài từ 3 kí tự trở lên",
            'Ten.max'       =>  "Bạn phải nhập tên có độ dài từ 3 Đến 100 kí tự",
        ];
    }
}
