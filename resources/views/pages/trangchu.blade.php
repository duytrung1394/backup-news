  @extends('layout.index')
  @section('content')
  <div class="container">

    	<!-- slider -->
    	@include('layout.slide')
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
        @include('layout.menu')

            <div class="col-md-10">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
	            		@foreach($theloai as $tl)
					    	@if(count($tl->loaitin)>0)
					    	<div class="row-item row">
		                	<h3>
		                		<a href="javascript:void(0)">{{$tl->Ten}}</a> | 	
		                		@foreach($tl->loaitin as $lt)
		                		<small><a href="loaitin/{{$tl->id}}/{{$tl->TenKhongDau}}.html"><i>{{$lt->Ten}}</i></a>/</small>
		                		@endforeach
		                	</h3>
		                	<!-- lấy ra 5 tin tức nổi bật mới nhất// sắp thếm theo thứ tự thời gian -->
		                	<?php 
		                		$data = $tl->tintuc->where('NoiBat',1)->sortByDesc('created_at')->take(5);
								//lấy ra 1 tin mới nhất để in phía bên trái
		                		//shift() hàm lấy dữ liệu 1 tin trong $data, trong data chi còn 1 tin
		                		//shift trả về kiểu mảng
		                		$tin1 = $data->shift();
		                	?>
		                	@if(isset($tin1))
		                	<div class="col-md-8 border-right">
		                		<div class="col-md-5">			              
			                        <a href="chitiet/{{$tin1->id}}/{{$tin1->TieuDeKhongDau}}.html">
			                            <img class="img-responsive" src="upload/tintuc/{{$tin1['Hinh']}}" alt="" style="width: 200px; height: 140px; margin-top: 30px; border-radius: 3px">
			                        </a>
			                    </div>

			                    <div class="col-md-7">
			                    	<a href="chitiet/{{$tin1->id}}/{{$tin1->TieuDeKhongDau}}.html">
			                        	<h3>{{$tin1['TieuDe']}}</h3>
			                    	</a>
			                        <p>{{$tin1['TomTat']}}</p>
			                        <a class="btn btn-primary" href="detail.html">Chi tiết <span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>

		                	</div>
		                    

							<div class="col-md-4">
								@foreach($data as $tin)

								<a href="chitiet/{{$tin->id}}/{{$tin->TieuDeKhongDau}}.html">
									<h4 style="font-size: 1.05em">
										<span class="glyphicon glyphicon-list-alt"></span>
										{!!$tin->TieuDe!!}
									</h4>
								</a>
								@endforeach
							</div>
							
							<div class="break"></div>
							@endif
		                </div>
		               	 	@endif
		                <!-- end item -->
		                @endforeach
		                <!-- end item -->
		                

					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
@endsection
@section('title')
    {{'Trang thông tin và xã hội'}}
@endsection 