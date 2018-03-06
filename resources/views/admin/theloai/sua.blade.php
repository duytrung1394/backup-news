@extends('admin.layout.index')
@section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thể Loại
                            <small>{{$theloai->Ten}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Warning</strong> 
                                @foreach($errors->all() as $err)           <!--  Đuyệt danh sach lỗi để inra -->
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>Success</strong> 
                                {{session('thongbao')}}          <!--  In session thong bao -->
                            </div>
                        @endif
                        <form action="admin/theloai/sua/{{$theloai->id}}" method="POST">
                             <div class="form-group">
                                <label>Tên Thể Loại</label>
                                <input class="form-control" name="Ten" placeholder="Nhập tên thể loại" value='{{$theloai->Ten}}'/>
                            </div>

                            <button type="submit" class="btn btn-default">Lưu Lại</button>
                            <button type="reset" class="btn btn-default">Reset</button>
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