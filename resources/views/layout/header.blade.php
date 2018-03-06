 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="trangchu">Laravel Tin Tức</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="trangchu">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="lienhe">Liên hệ</a>
                    </li>
                </ul>

                <form class="navbar-form navbar-left" role="search">
			        <div class="form-group">
			          <input type="text" class="form-control" placeholder="Search">
			        </div>
			        <button type="submit" class="btn btn-default">Submit</button>
			    </form>

			    <ul class="nav navbar-nav pull-right">
                   
                    @if(Auth::check())
                    <li>
                    	<a style="cursor: pointer">
                    		<span class ="glyphicon glyphicon-user"></span>
                    		{{Auth::user()->name}}
                    	</a>
                    </li>
                     <li>
                        <a href="dangxuat">Đăng xuất</a>
                    </li>
                    @else 
                        <li>
                            <a href="dang-ki">Đăng ký</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">Đăng nhập</a>
                        </li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    

        <!-- Modal -->
       
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog  modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                
                 <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Đăng nhập</h4>
                </div>
                    <div class="panel-body" id="modal-dangnhap">
                        <form>
                            <div style="position: relative;">
                                <input type="email" class="form-control" id="lg-email" placeholder="Vui lòng nhập email" name="txtEmail"  
                                ><span class="glyphicon glyphicon-remove"></span>
                            </div>
                            <br>    
                            <div style="position: relative;">
                                <input type="password" class="form-control" id="lg-pass" placeholder="Vui lòng nhập mật khẩu" name="txtPass">
                                <span class="glyphicon glyphicon-remove"></span>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary" id="btn-dangnhap">Đăng nhập
                            </button>
                            <p class="messages errors" style="display: none">Sai email hoặc mật khẩu</p>
                            {{csrf_field()}}
                        </form>

                    </div>
                </div>
            </div>
        </div>
       