<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\Comment;
use App\User;

use Illuminate\Support\Facades\Auth;
class PageController extends Controller
{
	function __construct()
	{	//truyyền viewshare . $the loại tới kahcs mọi trang trong page
		$theloai = TheLoai::all();
		$slide = Slide::all();
		view()->share(['theloai'=>$theloai,'slide'=>$slide]);
	}

    public function trangchu()
    {
    	return view('pages.trangchu');
    }
    public function lienhe()
    {
    	return view('pages.lienhe');
    }

    public function loaitin($id)
    {   
        $loaitin    = LoaiTin::find($id);
        $tintuc     = TinTuc::where('idLoaiTin',$id)->orderBy('id','desc')->select('id','TieuDe','Hinh','TomTat','TieuDeKhongDau')->paginate(5);      //paginate() phan trang
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }
    public function chitiet($id)
    {
        $tintuc         =   TinTuc::find($id);
        $idLoaiTin      =   $tintuc->idLoaiTin;
        $tinlienquan    =   TinTuc::where('idLoaitin',$idLoaiTin)->orderBy('id','desc')->select('id','TieuDe','Hinh','TomTat','TieuDeKhongDau')->take(4)->get();
        $tinnoibat      =   TinTuc::where('NoiBat','1')->orderBy('id','desc')->select('id','TieuDe','Hinh','TomTat','TieuDeKhongDau')->take(4)->get();
        $comment        =   Tintuc::find($id)->comment()->orderBy('id','desc')->paginate(10);
        return view('pages.chitiet',['tintuc'=>$tintuc,'tinlienquan'=>$tinlienquan,'tinnoibat'=>$tinnoibat,'comment'=>$comment]);
    }
    // ta dùng cách đăng nhập qua ajax
    // public function getDangNhap()
    // {   //lấy url cũ trước khi chuyển trang đăng nhập
    //     if(isset($_SERVER['HTTP_REFERER'])){
    //         $url=$_SERVER['HTTP_REFERER'];  
    //         session(['url'=>$url]);
    //     }
    //     return view('pages.dangnhap');
    // }

    // public function postDangNhap(Request $request)
    // {
    //     $this->validate($request,
    //         [
    //             'txtEmail'  =>  "required|email",
    //             'txtPass'   =>  "required"
    //         ],
    //         [
    //             'txtEmail.required'     =>  "Bạn chưa nhập email",
    //             'txtEmail.email'        =>  "Bạn phải nhập email",
    //             'txtPass.required'      =>  "Bạn chưa nhập mật khẩu"
    //         ]
    //     );
    //     $email      =   $request->txtEmail;
    //     $password   =   $request->txtPass;
    //     //dung thu vien AUTH để kiểm tra dang nhập
    //     if(Auth::attempt(['email'=>$email,'password'=>$password]))
    //     {  
    //         if(session()->has('url')){  //nếu tồn tại session url thì chuyển hướng về url cũ
    //             return redirect(session('url'));
    //         }else{
    //             return redirect('trangchu');
    //         }
           
    //     }else
    //     {
    //         return redirect("dangnhap")->with('thongbao',"Sai email hoặc mật khẩu");
    //     }
    // }
    public function getDangXuat()
    {
        Auth::logout();
        return redirect()->route('index'); //chuyeển hướng bằng cách gọi định danh
    }

    public function getDangKi()
    {

        return view('pages.dangki');
    }

    public function postDangKi(Request $request)
    {
        $user = new User;
        $name =$user->name =   $request->txtName;
        $user->email =  $request->txtEmail;
        $user->password =   bcrypt($request->password);
        $user->save();
        $message = true;
        echo json_encode(["name" => $name,'mess'=>$message]
        );
    }
}
