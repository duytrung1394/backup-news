
@extends('layout.index')
@section('content')	
		<div class="container">
    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
				  	<div class="panel-heading">Đăng ký tài khoản</div>
				  	<div class="panel-body" id="form-dangki">
				    	<form action="ajax/dangki" method="post" class='form-dangki'>
				    		<div>
				    			<label>Họ tên</label>
							  	<input type="text" class="form-control" placeholder="Username" id="name" name="txtName" aria-describedby="basic-addon1">
							  	<p class="errors" ></p>
							</div>
					
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" id="email" placeholder="Email" name="txtEmail" aria-describedby="basic-addon1">
							  	<p class="errors"></p>
							</div>
					
							<div>
				    			<label>Nhập mật khẩu</label>
							  	<input type="password" class="form-control" name="password" id="password" aria-describedby="basic-addon1">
							  	<p class="errors"></p>
							</div>
						
							<div>
				    			<label>Nhập lại mật khẩu</label>
							  	<input type="password" class="form-control" name="passwordAgain" id='confirm-pass' aria-describedby="basic-addon1">
							  	<p class="errors"></p>
							</div>
				
							<button type="submit" class="btn btn-default">Đăng ký
							</button>
							<div class="alert alert-success" style="display:none; text-align: center; margin-top: 20px; padding: 7px;">
								
							</div>
				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-3">
            </div>
        </div>
        <!-- end slide -->
    </div>
@endsection
@section('script')
  	<script type="text/javascript">
  		$(document).ready(function (){
  			$("#footer-a").hide();

  			$(".form-dangki").on('submit',function(){
  				n     	= 	$('#name').val();
  				email 	= 	$('#email').val();
  				pass  	=	$('#password').val();
  				cfpass =	$('#confirm-pass').val();		
  				var errors = false;
  				if(n=="")
  				{
 					$('#name').next(".errors").html("Vui lòng nhập tên");
  					$('#name').next(".errors").fadeIn();
  					errors = true;	
  				}
  				if(email=="")
  				{
 					$('#email').next(".errors").html("Vui lòng nhập email");
  					$('#email').next(".errors").fadeIn();
  					errors = true;	
  				}
  				if(pass=="")
  				{
 					$('#password').next(".errors").html("Vui lòng nhập mật khẩu");
  					$('#password').next(".errors").fadeIn();
  					errors = true;

  				}else if(cfpass!=pass){
 					$('#confirm-pass').next(".errors").html("Mật khẩu không khớp");
  					$('#confirm-pass').next(".errors").fadeIn();
  					errors = true;
  				}

  				if(errors==true)
  				{
  					return false;
  				}else 
  				{
  					var form = $(this);
	  				var formData = new FormData($(this)[0]);
	  				$.ajax({
	  					url: form.attr('action'),
	  					type: form.attr('method'),
	  					data: formData,
	  					dataType: 'json',
	  					cache: false,				// To unable request pages to be cached
						contentType: false,			// The content type used when sending data to the server.
						processData: false,			// To send DOMDocument or non processed data file it is set to false
						async: false,
						success:function(kq)
						{
							console.log(kq);
							if(kq.mess ==true)
							{	
								$(".alert-success").html('Thanh cong! Tên của bạn là: '+kq.name);
								$(".alert-success").fadeIn();
							}
						}
  					});
  				return false;
  				}
  			});
  			$('#name').keyup(function(){
  				$(this).next(".errors").fadeOut();
  			});
  			$('#password').keyup(function(){
  				$(this).next(".errors").fadeOut();
  			});
  			$('#email').keyup(function(){
  				$(this).next(".errors").fadeOut();
  			});
  			$('#confirm-pass').keypress(function(){
  				$(this).next(".errors").fadeOut();
  			});
  		});
  	</script>
@endsection 
