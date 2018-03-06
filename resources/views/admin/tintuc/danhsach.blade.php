@extends('admin.layout.index')
@section('content')
    <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tức
                            <small>Danh Sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th width="200px;">Tiêu Đề</th>
                                <!-- <th>Tóm Tắt</th> -->
                                <th>Hình</th>
                                <th>Thể Loại</th>
                                <th>Loại Tin</th>
                                <th>Số Lượt Xem</th>
                                <th>Nội Bật</th>
                                <th>Xóa</th>
                                <th>Sửa</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($tintuc as $tin)
                           
                            <tr class="odd gradeX" align="center">
                                <td>{{$tin->id}}</td>
                                <td>{{$tin->TieuDe}}
                                </td>
                                <td><img src="upload/tintuc/{{$tin->Hinh}}" width="100px" /></td>
<!--                                 <td>{{$tin->TomTat}}}</td>
 -->                               <td>{{$tin->loaitin->theloai->Ten}}</td>   <!-- Co the tro tu tin->tintuc->theloai->Ten để lấy theloai -->
                                <td>{{$tin->loaitin->Ten}}</td>
                                <td>{{$tin->SoLuotXem}}</td>
                                <td>
                                @if($tin->NoiBat==1) {{'Có'}}
                                @else {{'Không'}}
                                @endif 
                                </td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{$tin->id}}" class='btn-xoa'> Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{$tin->id}}">Sửa</a></td>
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