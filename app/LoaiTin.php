<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiTin extends Model
{
    //
    protected $table = 'loaitin';
    public function theloai()
    {
    	return $this->belongsTo('App\TheLoai','idTheLoai','id');
    }
    public function tintuc()
    {	////hasMany ('Model cần kết nối','Khoa Phu của bảng cần kết nối(tintuc)','Khóa chính của bảng Loaitin');
    	return $this->hasMany('App\TinTuc','idLoaiTin','id');
    }
}
