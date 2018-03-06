<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Comment;
class UserController extends Controller
{
  
   	public function getDanhSach()
   	{
         //Lấy danh sách user
         $user = User::all();
         return view('admin.user.danhsach',['users'=>$user]);
   	}
   
   	public function getThem()
   	{	
         return view('admin.user.them'); 
   	}

   	public function postThem(Request $request)				
   	{
         $this->validate($request,
            [ 
               'txtName'            => "required|min:4",
               'txtEmail'           => "required|email|unique:users,email",
               'txtPass'            => "required|min:6|max:30",
               'txtConfirmPass'     => "required|same:txtPass",         //Same:txtpass bắt buộc phải giốngtxtpass           
            ],
            [
               'txtName.required'   => "Bạn chưa nhập tên người dùng",
               'txtName.required'   => "Tên người dùng phải có ít nhất 3 kí tự",
               'txtEmail.required'  => "Bạn chưa nhập Email",
               'txtEmail.email'     => "Bạn chưa nhập đúng định dạng Email",
               "txtEmail.unique"    => "Email đã tồn tại",
               "txtPass.required"   => "Bạn chưa nhập mật khẩu",
               'txtPass.min'        => "Mật khẩu có ít nhất 6 kí tự",
               "txtPass.Max"        => "Mật khẩu không được quá 30 kí tự",
               "txtConfirmPass.required" => "Bạn chưa Confirm mật khẩu",
               "txtConfirmPass.same"=> "Mật khẩu không khớp",
            ]
         );	

         $user =new User();   
         $user->name       = $request ->  txtName; 
         $user->email      = $request ->  txtEmail; 
         $user->password   = bcrypt($request->txtPass); 
         $user->quyen      = $request ->  rdoQuyen;
         $user->save();
         return redirect('admin/user/them')->with('thongbao','Bạn đã thêm User thành công');
   	
      }

      public function getSua($id)
      {  
         $user = User::find($id);

         return view('admin.user.sua',['user'=>$user]);
      }
      public function postSua(Request $request,$id)
      {  
         $this->validate($request,
            [
               'txtName'            => "required|min:4",
               'txtEmail'           => "required|email|unique:users,email,".$id,
            ],
            [
               'txtName.required'   => "Bạn chưa nhập tên người dùng",
               'txtName.required'   => "Tên người dùng phải có ít nhất 3 kí tự",
               'txtEmail.required'  => "Bạn chưa nhập Email",
               'txtEmail.email'     => "Bạn chưa nhập đúng định dạng Email",
               "txtEmail.unique"    => "Email đã tồn tại",
            ]
         );

         $user = User::find($id);

         $user->name    =  $request->txtName;
         $user->email   =  $request->txtEmail;
         $user->quyen   =  $request->rdoQuyen;
         $user->save();

         return redirect("admin/user/sua/".$id)->with('thongbao','Sửa thông tin user thành công');
      }

      public function getXoa($id)
      {  
         //kiểm tra id user co tồn tại không
         if($user = User::find($id))        //đặt tìm thoongtin user cần xóa , có thể đặt $user để delete()
         {  
            //lấy danh sách comment của user để xóa
            $comment =  Comment::where('idUser',$id)->get();
            //duyệt qua từng comment để xóa
            foreach ($comment as $key) {
               $key->delete();
            }
            $user->delete();
            return redirect('admin/user/danhsach')->with('thongbao','Xóa thành công');
         }
         else
         {
            return redirect('admin/user/danhsach');
         }
      }

      public function getloginAdmin()
      {
         return view("admin.login");
      }

      public function postloginAdmin(Request $request)
      {
         $this->validate($request,
            [
               "txtEmail"     => "required|email",
               "txtPass"      => "required"
            ],
            [
               "txtEmail.required"  => "Bạn chưa nhập email",
               "txtEmail.email"     => "Phải nhập vào email",
               "txtPass.required"   => "Bạn chưa nhập Mật khẩu"
            ]
         );

         $email      =  $request->txtEmail;
         $password   =  $request->txtPass;
         //dung Auth để kiểm tra dăng nhập với so sánh 2 cột email password với email va pass request 
         if(Auth::attempt(['email'  => $email,'password' => $password]))
         {
            return redirect("admin/index");
         }
         else{
            return redirect("admin/dangnhap")->with("loi","Đăng nhập không thành công");
         }
      }
      public function getlogoutAdmin()
      {
         Auth::logout();
         return redirect("admin/dangnhap");
      }
}
