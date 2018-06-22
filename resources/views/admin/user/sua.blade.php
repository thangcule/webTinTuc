@extends('admin.layout.index')
@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Nguoi dung
                            <small>{{$user->name}}</small>
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
                        <form action="admin/user/sua/{{$user->id}}" method="POST">
                            
                            <div class="form-group">
                                <label>Tên nguoi dung</label>
                                <input class="form-control" name="name" placeholder="Điền tên nguoi dung" value="{{$user->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Điền Email" value="{{$user->email}}" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" name="password" placeholder="Điền Password" value="{{$user->password}}" />
                            </div>
                            
                            <button type="submit" class="btn btn-default">Sửa user</button>
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