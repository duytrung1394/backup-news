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
                    <div class="col-lg-8" style="padding-bottom:120px">
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
                        <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype='multipart/form-data'> 
                            <div class="form-group">
                                <label>Tên Slide</label>
                                <input class="form-control" name="txtTen" placeholder="Điền vào tên slide" value="{{$slide->Ten}}"/>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control" rows="3" name="txtNoiDung" placeholder="Điền vào nội dung" >{{$slide->NoiDung}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Link bài viết</label>
                                <input class="form-control" name="txtLink" placeholder="Điền vào đường dẫn" value="{{$slide->link}}" />
                            </div>
                            <div class="form-group">
                                <label>Hình slide cũ</label>
                                <img src="upload/slide/{{$slide->Hinh}}" width="250px" style="margin:15px;border-radius:5px;">
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="Hinh">

                            </div>
                            <button type="submit" class="btn btn-default">Lưu Lại</button>
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