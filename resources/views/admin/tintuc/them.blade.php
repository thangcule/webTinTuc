@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>Thêm tin tức</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                         @if(count($errors)>0)
                            <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                            </div>
                        @endif 
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                             {{session('thongbao')}}
                            </div>
                         @endif   
                        <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="theloai" id="theloai">
                                   
                                    @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại tin</label>
                                <select class="form-control" name="loaitin" id="loaitin">
                                   
                                    @foreach($loaitin as $lt)
                                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề" />
                            </div>
                            
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea name="TomTat" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="NoiDung" class="form-control" rows="6"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input  type="file" name="Hinh" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0" checked="" type="radio">Không
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" type="radio">Có
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Category Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                             <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            {{csrf_field()}}﻿
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection        

@section('script')
  <script type="">
      $(document).ready(function(){
            //alert('Đã chạy được');
            $("#theloai").change(function(){
                var idTheLoai = $(this).val();
                $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                         $("#loaitin").html(data);
                });
            });
      });


  </script>
@endsection