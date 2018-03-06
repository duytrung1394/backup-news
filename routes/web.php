<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// test lien ket
// Route::get('thu', function(){
// 	$theloai = App\TheLoai::find(1);
// 	//dung foreach de lay danh sach loai tin co the loai =1
// 	foreach ($theloai->loaitin as $loaitin) {
// 	 	echo $loaitin->TieuDe."<br/>";
// 	 } 
// });
Route::get('admin/dangnhap','UserController@getloginAdmin');

Route::post('admin/dangnhap','UserController@postloginAdmin');

Route::get('admin/dangxuat','UserController@getlogoutAdmin');

//Ta tao group admin để quản lí. để gọi về các trang  admin/groupcon/get(con)
//Thêm middleware đê ngăn chặn khi khoog dăng nhập cáo thẻ vào trang admin
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'], function () {
	//Group theloai
	Route::group(['prefix'=>'theloai'], function() {
		//Goi danh sach admin/theloai/danhsach
		Route::get('danhsach','TheLoaiController@getDanhSach');

		Route::get('sua/{id}','TheLoaiController@getSua');			//Thêm id để xác định id cần sửa

		Route::post('sua/{id}','TheLoaiController@postSua');

		Route::get('them','TheLoaiController@getThem');

		Route::post('them','TheLoaiController@postThem');			//Thêm route posthem

		Route::get('xoa/{id}','TheLoaiController@getXoa');
		
	});
	Route::group(['prefix'=>'loaitin'], function() {
		//Goi danh sach admin/theloai/danhsach
		Route::get('danhsach','LoaiTinController@getDanhSach');

		Route::get('sua/{id}','LoaiTinController@getSua');

		Route::post('sua/{id}','LoaiTinController@postSua');

		Route::get('them','LoaiTinController@getThem');

		Route::post('them','LoaiTinController@postThem');			//Thêm route posthem

		Route::get('xoa/{id}','LoaiTinController@getXoa');
		
	});
	Route::group(['prefix'=>'tintuc'], function() {
		//Goi danh sach admin/theloai/danhsach
		Route::get('danhsach','TinTucController@getDanhSach');

		Route::get('sua/{id}','TinTucController@getSua');

		Route::post('sua/{id}','TinTucController@postSua');

		Route::get('them','TinTucController@getThem');

		Route::post('them','TinTucController@postThem');			//Thêm route posthem

		Route::get('xoa/{id}','TinTucController@getXoa');
	});
	Route::group(['prefix'=>'slide'], function() {
		//Goi danh sach admin/theloai/danhsach

		Route::get('danhsach','SlideController@getDanhSach');

		Route::get('sua/{id}','SlideController@getSua');

		Route::post('sua/{id}','SlideController@postSua');

		Route::get('them','SlideController@getThem');

		Route::post('them','SlideController@postThem');			//Thêm route posthem

		Route::get('xoa/{id}','SlideController@getXoa');
	});
	Route::group(['prefix'=>'user'], function() {
		//Goi danh sach admin/theloai/danhsach
		Route::get('danhsach','UserController@getDanhSach');

		Route::get('sua/{id}','UserController@getSua');

		Route::post('sua/{id}','UserController@postSua');

		Route::get('them','UserController@getThem');

		Route::post('them','UserController@postThem');			//Thêm route posthem

		Route::get('xoa/{id}','UserController@getXoa');
	});

	//Group ajax
	Route::group(['prefix'=>'ajax'], function (){

		Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
	});
	//group comment
	Route::group(['prefix'=>'comment'], function (){
		Route::get('xoa/{id}','CommentController@getXoa');		//Lưu ý, khi truyền biến qua url phải viết trong dấu {}
		// Route::get('xoa/{id}/{idTinTuc}','CommentController@getXoa'); //có thể truyền thêm id tintuc để redirect
	});

	Route::get('index',function (){
		return view('admin.index');
	});
});


	Route::get('/',['as'=>'trang-chu','uses'=>'PageController@trangchu']);

	Route::get('lienhe','PageController@lienhe');

	Route::get('loaitin/{id}/{ten}.html','PageController@loaitin');

	Route::get('chitiet/{id}/{TenKhongDau}.html','PageController@chitiet');

	// Route::get('dangnhap','PageController@getDangNhap');

	// Route::post('dangnhap','PageController@postDangNhap');

	Route::get('dangxuat',"PageController@getDangXuat");

	Route::get('dang-ki',['as'=>'dangki','uses'=>'PageController@getDangKi']);
	
	Route::post('ajax/dangki','PageController@postDangKi');
	//Route comment bang ajax
	Route::post('ajax/comment','AjaxController@commentAjax');

	Route::post('ajax/dangnhap','AjaxController@postDangNhap');

	Route::get('account/{id}','PageController@getAccount');