@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thể Loại
                            <small>Danh Sách</small>
                        </h1>
                    </div>
                   
                     @if(session('thongbao'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Success</strong> 
                        {{session('thongbao')}}
                    </div>
                    @endif
                     
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">

                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên Thể Loại</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($theloai as $value)
                            <tr class="odd gradeX" align="center">
                                <td>{{$value->id}}</td>             
                                <td>{{$value->Ten}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/theloai/xoa/{{$value->id}}" class='btn-xoa'> Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/theloai/sua/{{$value->id}}">Sửa</a></td>
                            </tr>
                            @endforeach   
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
                
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection