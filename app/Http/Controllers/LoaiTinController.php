<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use App\Http\Requests\LoaiTinRequest;
class LoaiTinController extends Controller
{
    //Hiện danh sách
   	public function getDanhSach()
   	{	
   		$loaitin = LoaiTin::all();
   		return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
   	}
   	//Hiện Thêm Loại tin
   	public function getThem()
   	{	
   		$theloai = TheLoai::all();
   		return view('admin.loaitin.them',['theloai'=>$theloai]);
   	}

   	public function postThem(LoaiTinRequest $request)				//request tu form la 1 obj
   	{	
   		// Đã sử dụng class request
   		$this->validate($request,[
   	      'txtten'	  =>	'required|unique:LoaiTin,Ten|min:3|max:100',			//unique::Tenbang,Ten cột =?Dể không bi trung
   	     ],[
   			'txtten.required'	=> 'Bạn chưa nhập tên loại Tin',
   		]);
   		$loaitin = new LoaiTin;
   		$loaitin->Ten = $request->txtten;
   		$loaitin->idTheLoai = $request->txttheloai;
   		$loaitin->TenKhongDau = changeTitle($request->txtten);
   		$loaitin->save();
   		return redirect("admin/loaitin/them")->with("thongbao",'Thêm thành công');
   	}

      public function getSua($id)
      {  
         $theloai = TheLoai::all();                //Lấy danh sách thể loại

         $loaitin = LoaiTin::find($id);

         return view("admin.loaitin.sua",["theloai"=>$theloai,"loaitin"=>$loaitin]);

      }
      public function postSua(LoaiTinRequest $request,$id)
      {  
         $this->validate($request,[
            'txtten' => 'unique:LoaiTin,Ten,'.$id,                //unique::Tenbang,Ten cột =?Dể không bi trung
            ],[
            'txtten.unique'   => 'Tên loại tin đã tồn tại'
         ]);
         $loaitin = LoaiTin::find($id);                           //lấy thông tin của loai tin can sua
         $loaitin->Ten           = $request->txtten;
         $loaitin->idTheLoai     = $request->txttheloai;
         $loaitin->TenKhongDau   = changeTitle($request->txtten);
         $loaitin->save();
         return redirect("admin/loaitin/sua/".$id)->with('thongbao','Sửa thành Công');
      }

      public function getXoa($id)
      {

         if(LoaiTin::find($id)){
         // LoaiTin::destroy($id);//Cach 1 xoa theo khoa chinh
         //Tìm tất cả tin tức thuộc LoaiTin có idLoaitin = id

            $tintuc = LoaiTin::find($id)->tintuc()->get()->toArray();  //Luu i tintuc phari co ()

         //duyet qua từng tin tức trong obj để xóa
         foreach ($tintuc as $value) {
            $value->delete();
         }
            $loaitin = LoaiTin::find($id);
            $loaitin->delete();
            return redirect('admin/loaitin/danhsach')->with("thongbao",'Xóa thành công');
         }else
         {
            return redirect('admin/loaitin/danhsach');
         }
      }
}
   // $tintuc = LoaiTin::find($id)->tintuc()->select('TieuDe')->get()->toArray();// cách lấy tất cả tiêu đề từ trang tin tức có id thẻ loai bang id
   //SLECT NÊN ĐỂ ở trước get(); sau tất cả cac hanmf con lại
