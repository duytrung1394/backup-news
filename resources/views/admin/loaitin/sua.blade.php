@extends('admin.layout.index')
@section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>Edit</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                   <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Warning!!</strong>
                                @foreach($errors->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif
                         @if(session('thongbao'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Success</strong>
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/loaitin/sua/{{$loaitin->id}}" method="POST">        
                            <!-- Phải thêm id vào action để gửi sang function postSua -->
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="txttheloai" id='theloai'>
                                   <!--  <option value="0">Hãy chọn Thể loại</option> -->
                                    @foreach($theloai as $loai)
                                        @if($loai->id == $loaitin->idTheLoai)   
                                            <option value="{{$loai->id}}" selected="selected">{{$loai->Ten}}</option>
                                        @else 
                                            <option value="{{$loai->id}}">{{$loai->Ten}}</option>
                                        @endif
                                    @endforeach
                                </select>

                                <p class="alert alert-danger" style="display: none;padding: 9px; margin: 7px 0px;" >Bạn chưa chọn thể loại</p>
                            </div>
                            <div class="form-group">
                                <label>Tên Loại Tin</label>
                                <input class="form-control" id='ten' name="txtten" placeholder="Điền vào tên loại tin" value="{{$loaitin->Ten}}" />
                                <p  class="alert alert-danger" style="display: none; padding: 9px; margin: 7px 0px;" >Bạn chưa nhập Tên loại tin</p>
                            </div>
                            
                            <button type="submit" class="btn btn-default" id='submit'>Lưu Lại</button>
                            <button type="reset" class="btn btn-default">Hủy</button>
                            {{csrf_field()}}
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection