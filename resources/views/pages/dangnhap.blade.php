<!--  @extends('layout.index')
 @section('content') -->
 <div class="container" style="margin-top:60px">
    	<!-- slider -->
    	<div class="row carousel-holder">
    		<div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
                	
				  	<div class="panel-heading">Đăng nhập</div>
				  	<div class="panel-body">
				    	<form action="dangnhap" method="post">
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Email" name="txtEmail" 
							  	>
							</div>
							<br>	
							<div>
				    			<label>Mật khẩu</label>
							  	<input type="password" class="form-control" name="txtPass">
							</div>
							<br>
							<button type="submit" class="btn btn-default">Đăng nhập
							</button>
							{{csrf_field()}}
				    	</form>

				  	</div>
				  	@if(count($errors)>0)
	                	<div class="alert alert-danger">
	                		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                		<strong>Warning</strong> 
	                		@foreach($errors->all() as $err)
	                			{{$err}}
	                		@endforeach
	                	</div>
	                	@endif
	                	@if(session('thongbao'))
	                		<div class="alert alert-danger">
	                			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                			<strong>Warning</strong> 
	                			{{session('thongbao')}}
	                		</div>
	                	@endif
				</div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <!-- end slide -->
    </div>
<!--   @endsection

  @section('script')
  	<script type="text/javascript">
  		$(document).ready(function (){
  			$("#footer-a").hide();
  		});
  	</script>
  @endsection  -->
<!-- @section('title')
    {{'Đăng nhập'}}
@endsection  -->