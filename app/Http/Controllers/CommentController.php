<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
class CommentController extends Controller
{
    //
    public function getXoa($id)
    {	//Hoặc có thể truyền thêm idTinTuc trên url để xóa vả redirect về trang tintuc

    	// tim id cua tin tuc co comment de redirect
    	$tintuc = Comment::find($id);
    	$idtt= $tintuc->idTinTuc;
    	$tintuc->delete();
    	return redirect('admin/tintuc/sua/'.$idtt)->with('thongbao','Đã xóa comment thành công');
    }
}
