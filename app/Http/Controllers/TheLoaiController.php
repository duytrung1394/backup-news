<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use App\Http\Requests\TheLoaiRequest;

class TheLoaiController extends Controller
{
    public function getDanhSach()
    {	
    																	
    	$theloai = TheLoai::all();										//lấy tất cả thể loại
    	return view('admin.theloai.danhsach',['theloai'=>$theloai]);   	//truyền biến thể loai sang				
    }
    //Sửa
    public function getSua($id)
    {
    	$theloai =TheLoai::find($id);					//kết quả trả về của find(id) là 1 OBJ

    	return view('admin.theloai.sua',['theloai'=>$theloai]); //theemmang truyền biên theloai sang view
    }

    public function postSua(TheLoaiRequest $request,$id)
    {
    	$theloai =TheLoai::find($id);
    	//Kiểm tra điều kiên
  
    	$theloai->Ten =$request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();
    	return redirect('admin/theloai/sua/'.$id)->with('thongbao',"Sửa thành công"); //message
    }

    public function getThem()
    {	
  		return view('admin.theloai.them');
  	}

    public function postThem(TheLoaiRequest $request)
    {
    	// dung ham validate du lieu $this->validate($request,[],[])
    	$theloai= new TheLoai;										//Thêm
    	$theloai->Ten = $request ->Ten;
    	$theloai->TenKhongDau =	changeTitle($request->Ten) ; 		//Dùng function để đổi tên có dấu thành không dấu // 
    	//thêm thư viện function(App\function\function.php) vao composer auto load
    	$theloai->save();
    	return redirect('admin/theloai/them')->with('thongbao','Thêm thành công'); //with truyền thông báo để hiên thị/
    																			// session thong bao de in thong bao ra
    }
    public function getXoa($id)
    {   
        if(TheLoai::find($id)){
             //tìn tới tất cả loại tin có idTheLoai = $id
            $loaitin = LoaiTin::where('idTheLoai',$id)->get();    //get Sẽ cho ra một object
            //hoac tim loai tin qua thelaoi
            // $loaitin = TheLoai::find($id)->loaitin()->get();
            foreach ($loaitin as $key) {                        //Đuyệt qua từng phần tử để xóa phần tử con của thể loại
                $key->delete();
            }
            TheLoai::destroy($id);
             return redirect('admin/theloai/danhsach')->with('thongbao','Xóa thành công');
        }else
        {
            return redirect('admin/theloai/danhsach');  
        }
        
    }
}
