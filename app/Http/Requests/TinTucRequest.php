<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TinTucRequest extends FormRequest
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
            'LoaiTin'   => 'required',
            'TieuDe'    => 'required|min:3',
            'TomTat'    => 'required',
            'NoiDung'   => 'required',
          
        ];
    }

    public function messages()
    {
        return [
            'LoaiTin.required'   => "Bạn chưa chọn loại tin",
            'TieuDe.required'    => "Bạn chưa nhập tiêu dề",
            'TieuDe.min'         => "Tiêu đề có ít nhấp 3 kí tự",
            'TomTat.required'    => 'Bạn Chưa nhập tóm tắt',
            'NoiDung.required'   => "Bạn chưa nhập nội dung",
        ];
    }
}
