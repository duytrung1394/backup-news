<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use App\TinTuc;
use App\Comment;
use DateTime;                                                  //Goi DateTime De su dung Datetime
use App\Http\Requests\TinTucRequest;
class TinTucController extends Controller
{
    //Hiện danh sách
   	public function getDanhSach()
   	{	
   	  // $tintuc = TinTuc::orderBy('id','desc')->get();
         $tintuc =TinTuc::all();

        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
   	}
   	//Hiện Thêm Loại tin
   	public function getThem()
   	{	
         $theloai    = TheLoai::all();
         //lấy thể loại của chuyên mục dầu tiên
         $loaitin = $theloai[0]->loaitin;
         
   		return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
   	}

   	public function postThem(TinTucRequest $request)				//request tu form la 1 obj
   	{	
   		$this->validate($request,
            [
               'TieuDe'    => 'unique:tintuc,TieuDe',
               'Hinh'      => 'required'
            ],
            [
               'TieuDe.unique'      => "Tiêu đề đã tồn tại",
               'Hinh.required'      => "Bạn hãy chọn hình ảnh"
            ]
         );

      $tintuc =new TinTuc;
      $tintuc->TieuDe      =$request->TieuDe;
       //có thể dùng hàm str_slug('text','-') để chuyển sang dạng đường dẫn
      $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
      $tintuc->idLoaiTin   = $request->LoaiTin;
      $tintuc->TomTat      =$request->TomTat;
      $tintuc->NoiDung     = $request->NoiDung;
      $tintuc->NoiBat      = $request->NoiBat;
      $tintuc->SoLuotXem   = 0;
      $tintuc->created_at  = new DateTime();
      //lưu file
      $file = $request->file('Hinh');
      $allowed = array('image/jpg','image/png','image/jpeg');
      if(in_array($file->getClientMimeType(),$allowed)){
         $file_name= $file->getClientOriginalName();     //lấy tên file
         $hinh = uniqid("anh_",true).$file_name;
         //có thể dùng while(file_exits(duongdanh/tenfile)) để kiểm tra file có bị trùng khôg
         $file->move('upload/tintuc/',$hinh);                                       //tên file(có thể đặt tên mới)
         $tintuc->Hinh = $hinh;
         $tintuc->save();
         return redirect("admin/tintuc/them")->with('thongbao',"Thêm mới thành công");
      }else{
          return redirect("admin/tintuc/them")->with('loi',"Hình ảnh phải có dạng jpg,png");
      }
   }

      public function getSua($id)
      {  
         $tintuc = TinTuc::find($id);
         if(count($tintuc)>0){
             //lấy idthể loại của tintuc có id = $id trong bang loaitin
         $lt = Tintuc::find($id)->loaitin()->select('idTheLoai')->get(); 
         // chúng ta lấy được id thể loại
         $idTheLoai=$lt[0]->idTheLoai; //hoac viet $tin[0]['idTheLoai']
         //Lấy danh sách loại tin có id thể loại = $idTheLoai
         $loaitin = TheLoai::find($idTheLoai)->loaitin()->get();
         //lấy danh sach thể loại
         $theloai = TheLoai::all();
         //lấy tin tức có id = $id
         $tintuc = TinTuc::find($id);
         return view('admin.tintuc.sua',['tintuc'=>$tintuc,'loaitin'=>$loaitin,'theloai'=>$theloai]);
         }else{
            return abort(404);                     //tintuc
         }

        
      }
      public function postSua(TinTucRequest $request,$id)
      {  
        $this->validate($request,
            [
               'TieuDe' => 'unique:tintuc,TieuDe,'.$id,
            ],
            [
               'TieuDe.unique' => "Tiêu đề đã tồn tại"
            ]
         );

         $tintuc = TinTuc::find($id);
         $tintuc->TieuDe            =  $request->TieuDe;
         //có thể dùng hàm str_slug('text','-') để chuyển sang dạng đường dẫn
         $tintuc->TieuDeKhongDau    =  changeTitle($request->TieuDe);
         $tintuc->idLoaiTin         =  $request->LoaiTin;
         $tintuc->TomTat            =  $request->TomTat;
         $tintuc->NoiDung           =  $request->NoiDung;
         $tintuc->NoiBat            =  $request->NoiBat;
         $tintuc->updated_at        =  new DateTime();          //goi DateTime de lay thoi gian
         if($request->hasFile('Hinh'))
         {  
            $file    =  $request->file('Hinh');
            $allowed = array('image/jpg','image/png','image/jpeg');

            if(in_array($file->getClientMimeType(),$allowed)){
               $file_name= $file->getClientOriginalName();     //lấy tên file
               $hinh = uniqid("anh_",true).$file_name;
               //có thể dùng while(file_exits(duongdanh/tenfile)) để kiểm tra file có bị trùng khôg
               $file->move('upload/tintuc',$hinh);                                       //tên file(có thể đặt tên mới)
               $tintuc->Hinh = $hinh;

               $tintuc->save();

               return redirect('admin/tintuc/sua/'.$id)->with("thongbao",'Sửa thành công');
            }else
            {
               return redirect('admin/tintuc/sua/'.$id)->with("loi",'Hình ảnh có định dạng jpg, jpeg hoặc png');
            }
         }
         else{
              $tintuc->save();
            return redirect('admin/tintuc/sua/'.$id)->with("thongbao",'Sửa thành công');
          }
      }

      public function getXoa($id)
      {  
         if(TinTuc::find($id)){
            $comment = TinTuc::find($id)->comment()->get();
            foreach ($comment as $key)
            {                        //Đuyệt qua từng phần tử để xóa phần tử con của tintuc
               $key->delete();
            }       
         TinTuc::destroy($id);
         return redirect('admin/tintuc/danhsach')->with("thongbao",'Xóa thành cônng');
      }else{
         return redirect('admin/tintuc/danhsach');
      }
   }
}
