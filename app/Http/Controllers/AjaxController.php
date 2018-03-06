<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use App\Comment;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AjaxController extends Controller
{	
	public function getLoaiTin($idTheLoai)
	{
		$loaitin = LoaiTin::where('idTheLoai',$idTheLoai)->get();
		foreach ($loaitin as $lt) {
			echo "<option value='".$lt->id."'>".$lt->Ten."</option>";
		}
	}

	public function commentAjax(Request $request)
	{	
		$comment = new Comment;
		$comment->NoiDung 	= $request->comment;
		$comment->idTinTuc 	= $request->tinid;
		$comment->idUser  	= Auth::user()->id;
		$comment->created_at = new DateTime();
		$comment->save();
		$name = Auth::user()->name;
		echo "<div class='media'>
                    <a class='pull-left' href='#'>
                        <img class='media-object' src='upload/icon.jpg' witdh='110px' height='90px' alt=''>
                    </a>
                    <div class='media-body'>
                        <h4 class='media-heading'>".$name."<small style='margin-left:15px;'>Vừa xong</small>
                    </h4>
                ".$request->comment."
            </div>
         </div>'";

	}
	public function postDangNhap(Request $request)
    {
    	$email      =   $request->email;
        $password   =   $request->pass;
        //dung thu vien AUTH để kiểm tra dang nhập
        if(Auth::attempt(['email'=>$email,'password'=>$password]))
        {  
           echo "true";
        }
        else
        { 
            echo "false";
        }
    }
}