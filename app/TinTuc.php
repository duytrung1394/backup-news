<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    //
    protected $table = 'tintuc';

    public function loaitin()
    {	//belongsTo('App\ModelCan ket noi','Khoaphu','Khoa Chinh của cha mẹ');
    	return $this->belongsTo('App\LoaiTin','idLoaiTin','id');
    }
    public function comment()
    {
    	return $this->hasMany('App\Comment','idTinTuc','id');
    }
}
