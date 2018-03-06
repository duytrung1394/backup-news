$(".menu1").next('ul').toggle();

$(".menu1").click(function(event) {
	$(this).next("ul").toggle(500);
});
//ajax đăng nhập
$(document).ready(function(){
	$("#btn-dangnhap").click(function() {
		e = $("#lg-email").val();
		p = $("#lg-pass").val();
		errors =false;
		if(e=="")
		{
			$("#lg-email").next('.glyphicon').fadeIn();
			errors=true;
		}
		if(p=="")
		{
			$("#lg-pass").next('.glyphicon').fadeIn();
			errors=true;
		}
		if(errors==true)
		{
			return false;
		}else
		{
			$.ajax({
				url: "ajax/dangnhap",
				type: "post",
				data: "email="+e+"&pass="+p,
				async: true,
				success:function(kq)
				{
					// console.log(kq);
					if(kq=="true")
					{
						window.location.reload();
					}else{
						$('.messages').fadeIn();
					}
				}
			});
			return false;
		}
	})
	$("#lg-email").keyup(function(){
		$(this).next('.glyphicon').fadeOut();
	});
	$("#lg-pass").keyup(function(){
		$(this).next('.glyphicon').fadeOut();
	});
});