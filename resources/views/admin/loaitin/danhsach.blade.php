@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên Loại Tin</th>
                                <th>Tên Không Dấu</th>
                                <th>Thể Loại</th>          
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($loaitin)>0)
                                @foreach($loaitin as $loai)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$loai->id}}</td>
                                    <td>{{$loai->Ten}}</td>
                                    <td>{{$loai->TenKhongDau}}</td>    <!-- //in cột cha:  biến truyên qua->pt lên kết->Cột cần in -->
                                    <td>{{$loai->theloai->Ten}}</td>   <!--  //Để In ra Tên Của thể Loại D dùng $loai->theloai->Ten -->
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a class='btn-xoa' href="admin/loaitin/xoa/{{$loai->id}}">Xóa</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/loaitin/sua/{{$loai->id}}">Sửa</a></td>
                                </tr>
                            @endforeach
                            @else
                                <tr class="odd gradeX" align="center">
                                    <td>Chưa có Loại tin nào</td>
                                </tr>
                            @endif
                           
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
      
@endsection