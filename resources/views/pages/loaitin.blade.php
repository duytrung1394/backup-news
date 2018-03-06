@extends('layout.index')
@section('content')
   <div class="container">
        <div class="row">
            @include('layout.menu')
            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>{{$loaitin->Ten}}</b></h4>
                    </div>
                    @foreach($tintuc as $tin)
                    <div class="row-item row">
                        <div class="col-md-4">
                            <a href="chitiet/{{$tin->id}}/{{strtolower($tin->TieuDeKhongDau)}}.html">
                                <br>
                                <img style='width:250px; height:170px;border-radius: 5px;' class="img-responsive" src="upload/tintuc/{{$tin->Hinh}}" alt="{{$tin->Hinh}}">
                            </a>
                        </div>

                        <div class="col-md-8">
                           
                            <h3><a href="chitiet/{{$tin->id}}/{{strtolower($tin->TieuDeKhongDau)}}.html">{{$tin->TieuDe}}</a></h3>
                            <p>{{$tin->TomTat}}}</p>
                            <a class="btn btn-primary" href="chitiet/{{$tin->id}}/{{strtolower($tin->TieuDeKhongDau)}}.html">View Project <span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <div class="break"></div>
                    </div>
                    @endforeach
                    {{$tintuc->links()}}
                    <!-- /.row -->

                </div>
            </div> 

        </div>

    </div>
@endsection
@section('title')
    {{$loaitin->Ten}}
@endsection 
