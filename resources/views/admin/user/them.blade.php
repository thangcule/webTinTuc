@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Thêm</small>
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
                        <form action="admin/user/them" method="POST">
                            
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="name" placeholder="Nhập tên người dùng" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Nhập Email" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" name="password" placeholder="Nhập mật khẩu" />
                            </div>
                            
                            <button type="submit" class="btn btn-default">Thêm người dùng</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            
                            {{csrf_field()}}﻿
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection        