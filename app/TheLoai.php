<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheLoai extends Model
{
    //
    protected $table = 'theloai';

    public function loaitin()
    {	//hasMany ('Model cần kết nối','KhoaPhu của bảng cần kết nối','Khóa chính của bảng TheLoai');
    	return $this->hasMany('App\LoaiTin','idTheLoai','id');
    }
    public function tintuc()
    {	//lien ket tu the loai den tin tuc qua trung gian loai tin (tintuc/loaitin/idtheloai)
    	return $this->hasManyThrough('App\TinTuc','App\LoaiTin','idTheLoai','idLoaiTin','id');
    }
}
