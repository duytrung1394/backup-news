@extends('layout.index')
@section('content')
<div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><a href="chitiet/{{$tintuc->id}}/{{$tintuc->TieuDeKhongDau}}.html">{{$tintuc->TieuDe}}</a></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Trung duy</a>
                </p>
                <!-- Date/Time -->
                <!--Su dung hàm thư viện \Carbon\Carbon::createFormTimeStamp(strtotime($tintuc->created_at))->diffforHumans()
                để chuyển về dạng ngày giờ-->
                <?php 
                Carbon::setLocale('vi') ; //dùng để đinh nghĩa time
                if(Carbon::createFromTimestamp(strtotime($tintuc->created_at))->diffInHours() >= 24)
                    $time =         $tintuc->created_at;
                    else $time =    Carbon::createFromTimestamp(strtotime($tintuc->created_at))->diffforHumans();
                ?>            
                <p><span class="glyphicon glyphicon-time" style="margin-right: 10px"></span>    @if($tintuc->created_at)  {!!  $time !!}  @else 20/07/2017 @endif</p>
                <hr>
                <!-- Post Content -->
                <p class="lead">{!!$tintuc->NoiDung!!}</p>  {{--để in ra nội dung ẩn đi các thẻ html dùng !!text!!--}}

                <hr>
                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well" id='comm'>
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" id="comment-content" ></textarea>
                            <p class="errors" style="display: none;text-align: center; padding: 5px;color:#f42727"></p>          
                        </div>

                        <button type="submit" id="btn-comment" data-tinid={{$tintuc->id}} class="btn btn-primary" @if(Auth::check() == false) {{'disabled'}} @endif >Gửi</button>
                        @if(Auth::check()==false) {!!"<span style='margin-left: 50px; color: #f42727'>Vui lòng đăng nhập để bình luận</span>"!!} @endif
                    </form>
                </div>
                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div id="list-comment">
                    @foreach($comment as $cm)
                    <div class='media'>
                    <a class='pull-left' href='#'>
                        <img class='media-object' src='upload/icon.jpg' witdh='110px' height='90px' alt=''>
                    </a>
                    <div class='media-body'>
                        <h4 class='media-heading'>{{$cm->user->name}}
                        <?php Carbon::setLocale('vi') ; //dùng để đinh nghĩa time
                        if(Carbon::createFromTimestamp(strtotime($cm->created_at))->diffInHours() >= 24)
                            $timecomment =         $cm->created_at;
                            else $timecomment =    Carbon::createFromTimestamp(strtotime($cm->created_at))->diffforHumans();
                        ?>
                            <span><small>{{$timecomment}}</small></span>
                        </h4>
                        <div>
                            {{$cm->NoiDung}}
                        </div>
                     
                        </div>
                    </div>
                    @endforeach
                </div>
                <div style="text-align: center;">
                      {!! $comment->fragment('comm')->links() !!}   
                </div>
              
                <!-- fragment : thêm ('#list-comment') vào sau đường dẫn ở phân trang -->
               
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">
                        @foreach($tinlienquan as $tlq)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="chitiet/{{$tlq->id}}/{{strtolower($tlq->TieuDeKhongDau)}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$tlq->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="chitiet/{{$tlq->id}}/{{strtolower($tlq->TieuDeKhongDau)}}.html"><b>{{$tlq->TieuDe}}</b></a>
                            </div>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach
                       
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                        @foreach($tinnoibat as $tnb)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="chitiet/{{$tnb->id}}/{{strtolower($tnb->TieuDeKhongDau)}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$tnb->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="chitiet/{{$tnb->id}}/{{strtolower($tnb->TieuDeKhongDau)}}.html"><b>{{$tnb->TieuDe}}</b></a>
                            </div>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach
                      
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function (){
            $("#btn-comment").click(function (){
                c   = $("#comment-content").val();
                id  = $(this).attr("data-tinid");
                if(c=="")
                {
                    $("#comment-content").next('.errors').html('Bạn chưa nhập comment');
                    $("#comment-content").next('.errors').show();
                    return false;
                }else
                {
                    $.ajax({
                        url:    "ajax/comment",
                        type:   "post",
                        data:   "comment="+c+"&tinid="+id,
                        async:  true,
                        success:function(kq)
                        {   console.log(kq);
                            if($('.media').length==0){
                                $("#list-comment").html(kq);
                            }else{
                                $("#list-comment").prepend(kq);
                                $("#comment-content").val("");
                            }
                        }
                    });
                    return false;
                }

            });
             $("#comment-content").keyup(function(){
                $(this).next(".errors").fadeOut();
             });
        });
    </script>
@endsection
@section('title')
    {{$tintuc->TieuDe}}
@endsection 