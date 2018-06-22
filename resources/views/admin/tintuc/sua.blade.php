@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>{{$tintuc->TieuDe}}</small>
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
                        <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="theloai" id="theloai">
                                   
                                    @foreach($theloai as $tl)
                                    <option 

                                    @if($tintuc->loaitin->theloai->id==$tl->id)
                                    {{"selected"}}
                                    @endif


                                    value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại tin</label>
                                <select class="form-control" name="loaitin" id="loaitin">
                                   
                                    @foreach($loaitin as $lt)
                                    <option 
                                     @if($tintuc->loaitin->id==$lt->id)
                                     {{"selected"}}
                                     @endif
                                     value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề" value="{{$tintuc->TieuDe}}" />
                            </div>
                            
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea name="TomTat" class="form-control" rows="3">{{$tintuc->TomTat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea name="NoiDung" class="form-control" rows="6">{{$tintuc->NoiDung}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <p><img width="400px" src="upload/tintuc/{{$tintuc->Hinh}}"></p>
                                
                                <input  type="file" name="Hinh" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0" 
                                     @if($tintuc->NoiBat == 0)
                                     {{"checked"}}
                                     @endif

                                     type="radio">Không
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1"
                                      @if($tintuc->NoiBat == 1)
                                     {{"checked"}}
                                     @endif
                                     
                                     type="radio">Có
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                             <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            {{csrf_field()}}﻿
                        <form>
                    </div>
                </div>
                <!-- /.row -->

                 <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Binh luận
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('thongbao'))
                            <div class="alert alert-success">
                             {{session('thongbao')}}
                            </div>
                         @endif   
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th>Nội dung</th>
                                <th>Ngày đăng</th>
                               
                                <th>Delete</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc->comment as $cmt)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cmt->id}}</td>
                                <td>
                                   {{$cmt->user->name}}
                                   
                                </td>
                                <td>{{$cmt->NoiDung}}</td>
                                <td>{{$cmt->created_at}}</td>
                                
                                
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cmt->id}}/{{$tintuc->id}}"> Delete</a></td>
                               
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