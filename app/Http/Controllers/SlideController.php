<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

use App\Http\Requests\SlideRequest;

class SlideController extends Controller
{
    //Hiện danh sách
   	public function getDanhSach()
   	{	
   	   $slide = Slide::all();
         return view('admin.slide.danhsach',['slide'=>$slide]);
   	}
   	//Hiện Thêm Loại tin
   	public function getThem()
   	{	
   		return view('admin.slide.them');
   	}

   	public function postThem(SlideRequest $request)				//request tu form la 1 obj
   	{	

         $slide = new Slide;
         $slide->Ten          =  $request->txtTen;
         $slide->NoiDung      =  $request->txtNoiDung;
         $slide->link         =  $request->txtLink;

         $file    =  $request->file('Hinh');
         $allowed =  array('image/jpg','image/png','image/jpeg');

        if(in_array($file->getClientMimeType(),$allowed)){
            $file_name  = $file->getClientOriginalName();     //lấy tên file
            $hinh       = uniqid('anh_',true).$file_name;
            $file->move('upload/slide/',$hinh);
            $slide->Hinh = $hinh;
            $slide->save();
            return redirect('admin/slide/them')->with('thongbao','Thêm slide thành công');
         }else
         {
            return redirect('admin/slide/them')->with('loi','Hình ảnh có định dạng jpg, png, jpeg');
         }
         
   	}

      public function getSua($id)
      {  
         //lay danh sach slide
         $slide  =   Slide::find($id);
         return view('admin.slide.sua',['slide'=>$slide]); 

      }
      public function postSua(SlideRequest $request,$id)
      {
         //validate du lieu 
         // $this->validate($request,[],[]);
         

         //lay silde can chinh sua
         $slide = Slide::find($id);
         $slide->Ten       =  $request->txtTen;
         $slide->NoiDung   =  $request->txtNoiDung;
         $slide->link      =  $request->txtLink;

         if($request->hasFile('Hinh'))
         {
           $file    =  $request->file('Hinh');
            $allowed =  array('image/jpg','image/png','image/jpeg');

            if(in_array($file->getClientMimeType(),$allowed)){
            $file_name  = $file->getClientOriginalName();     //lấy tên file
            $hinh       = uniqid('anh_',true).$file_name;
            $file->move('upload/slide/',$hinh);
            $slide->Hinh = $hinh;
            $slide->save();
            return redirect('admin/slide/sua/'.$id)->with('thongbao','Sửa slide thành công');
            }
         else{
            return redirect('admin/slide/sua/'.$id)->with('loi','Hình ảnh có định dạng jpg, png, jpeg');
         }
      }else
         {
            $slide->save();
            return redirect('admin/slide/sua/'.$id)->with('thongbao','Sửa slide thành công');
         }
      }
      public function getXoa($id)
      {
         if($slide = Slide::find($id))
            {
               $slide->delete();
               return redirect('admin/slide/danhsach')->with('thongbao','Xóa thành công');
            }
      }
}
