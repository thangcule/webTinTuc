<head>
  <meta charset="UTF-8">
  <title></title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" style= "background-color: #fff;
    border-color: #9e9e9e1a;height: 60px;" role="navigation">
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
                        <a href="gioithieu">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="lienhe">Liên hệ</a>
                    </li>
                </ul>

                <form action="{{route('search')}}" method="get" class="navbar-form navbar-left" role="search">
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
			        <div class="form-group">
			          <input type="text" value="" name="key" id="s" class="form-control" placeholder="Tìm kiếm">
			        </div>
			        <button type="submit" class="btn btn-default">Tìm</button>
			    </form>

			    <ul class="nav navbar-nav pull-right">
                    @if(Auth::User()!=NULL)
                       <li>
                            <a href="nguoidung">
                                <span class ="glyphicon glyphicon-user"></span>
                                {{Auth::User()->name}}
                            </a>
                        </li>

                        <li>
                            <a href="dangxuat">Đăng xuất</a>
                        </li>
                    @else
                        <li>
                            <a href="dangky">Đăng ký</a>
                        </li>
                        <li>
                            <a href="dangnhap">Đăng nhập</a>
                        </li>
                        
                    @endif
                </ul>
            </div>


            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    