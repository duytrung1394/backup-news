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
                                <th>Tên</th>
                                <th>Hình</th>
                                <th>Nôi dung</th>
                                <th>Link</th>
                                <th width="50px">Xóa</th>
                                <th width="50px">Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($slide as $sl)
                            <tr class="odd gradeX" align="center">
                                <td>{{$sl->id}}</td>
                                <td>{{$sl->Ten}}</td>
                                <td><img src="upload/slide/{{$sl->Hinh}}" width="200px"></td>
                                <td>{{$sl->NoiDung}}</td>
                                <!-- word-wrap break-word giup xuong dong khi ki tu qua dai -->
                                <td><div style="word-wrap: break-word;width: 200px;">{{$sl->link}}</div></td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a class='btn-xoa' href="admin/slide/xoa/{{$sl->id}}">Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slide/sua/{{$sl->id}}">Sửa</a></td>
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