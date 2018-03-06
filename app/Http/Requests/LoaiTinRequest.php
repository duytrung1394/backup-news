<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoaiTinRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;            //đổi thành true dể thwujc hien
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'txtten'    =>  'required|min:3|max:100',            //unique::Tenbang,Ten cột =?Dể không bi trung
            'txttheloai'=>  'required'
        ];
    }
    public function messages()
    {
        return [
            'txtten.required'   => 'Bạn chưa nhập tên loại Tin',
            'txtten.min'        => 'Tên loại tin có độ dài từ 3 => 100 kí tự',
            'txtten.min'        => 'Tên loại tin có độ dài từ 3 => 100 kí tự',
            'txttheloai.required' => 'Bạn chưa chọn thể loại'
        ];
    }
}
