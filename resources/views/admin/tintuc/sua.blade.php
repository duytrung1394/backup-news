@extends('admin.layout.index')
@section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tức
                            <small>Sửa</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-10" style="padding-bottom:120px">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Warning!!</strong><br>
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif
                        <!-- In Thông báo -->
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Success</strong>
                                {{session('thongbao')}}
                            </div>
                        @endif
                         @if(session('loi'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Warning</strong>
                                {{session('loi')}}
                            </div>
                        @endif
                        <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Thể Loại</label>
                                <select class="form-control" id='select-theloai'>
                                    @foreach($theloai as $tl)
                                        @if($tintuc->loaitin->theloai->id == $tl->id)   <!-- Lấy id cua the loai  để so -->
                                            <option value="{{$tl->id}}" selected="selected">{{$tl->Ten}}</option>
                                        @else
                                            <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                         
                            <div class="form-group">
                                <label>Loại Tin</label>
                                <select class="form-control" id='loaitin' name='LoaiTin'>
                                     @foreach($loaitin as $lt)
                                        @if($tintuc->idLoaiTin == $lt->id)
                                            <option value="{{$lt->id}}" selected="selected">{{$lt->Ten}}</option>
                                        @else
                                            <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                        @endif
                                     @endforeach
                                </select>
                            </div>

                           <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề" value="{{$tintuc->TieuDe}}"  />
                            </div>
                            <div class="form-group">
                                <label>Tóm Tắt</label>
                                <textarea class="form-control" rows="3" id='demo' name="TomTat">{{$tintuc->TomTat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control ckeditor" rows="5" id='demo' name='NoiDung' >{{$tintuc->NoiDung}}</textarea>
                            </div>
                            <div>
                                <label>Hình ảnh cũ: </label><img src="upload/tintuc/{{$tintuc->Hinh}}" style="width:250px;margin: 20px;  border-radius: 5px">
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="Hinh" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0" type="radio"  @if($tintuc->NoiBat == 0) {{'checked'}} @endif >Có
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" type="radio"  @if($tintuc->NoiBat == 1) {{'checked'}} @endif>Không 
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Hủy</button>
                            {{csrf_field()}}
                        <form>
                    </div>
                </div>
                <!-- /.row -->
                <!--/.danhsachcomment row-->
                 <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tức
                            <small>Danh Sách</small>
                        </h1>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th width="200px;">Nội Dung</th>
                                <th>User</th>
                                <th>Ngày Tạo</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($tintuc->comment as $cm)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cm->id}}</td>
                                <td>{{$cm->NoiDung}}</td>
                                <td>{{$cm->user->name}}</td>    <!-- Có thể trỏ từ model Comment với func user để lấy tên user -->
                                <td>{{$cm->created_at}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}" class='btn-xoa'> Xóa</a></td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#select-theloai").change(function () {
                var id = $(this).val();
                //dung phuong thuc get với url : gọi lới controller ajax với id để hiện thi laoi tin theo change the laoi
                $.get('admin/ajax/loaitin/'+id,function(data){
                    $('#loaitin').html(data);
                });
            });
        });
    </script>
@endsection