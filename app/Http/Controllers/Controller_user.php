<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\user;

class Controller_user extends Controller
{
    //
    public function dangnhapAdmin(){
        return view('admin.login');
      

    }
    

    function postdangnhapAdmin(Request $request){

          $this->validate($request,
            [
               'email'=>'required',
               'password'=>'required|min:2|max:32'
               ],
            [
            'email.required'=>'Bạn chưa nhập email',
            'password.required'=>'Bạn chưa nhập password',
            'password.min'=>'Mật khẩu quá ngắn',
            'password.max'=>'Mật khẩu phải nhỏ hơn 32 kí tự'
               ]);
          if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('admin/user/danhsach');
          } else {
            return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
          }
    }

     function dangxuat(){
       Auth::logout();
       return redirect('admin/dangnhap');
     }

    public function danhsach(){
    	$user = user::all();
        return view('admin.user.danhsach',['user'=>$user]);
    	

    }

    

    public function them(){
         $user = user::all();
         return view('admin.user.them',['user'=>$user]);
    }
    public function postthem(Request $request){
         $this->validate($request,
            [
                'name'=>'required|min:2|max:50',
                'email'=>'required|min:2|max:100'       
              ],
            [
                'name.required'=>'Ban chưa nhập tên ',
                
                'name.min'=>'Tên nguoi dung  có độ dài từ 2 đến 50 kí tự',
                'name.max'=>'Tên nguoi dung có độ dài từ 2 đến 50 kí tự',
                'email.required'=>'Ban chưa nhập email ',
                
                'email.min'=>'Email  có độ dài từ 2 đến 100 kí tự',
                'email.max'=>'Email có độ dài từ 2 đến 100 kí tự'

              ]);
        $user = new user;
        $user->name =$request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        //echo changeTitle($request->name);
        $user->save();
        return redirect('admin/user/them')->with('thongbao','Thêm thành công');
    }

     public function sua($id){
        $user = user::find($id);
        return view('admin.user.sua',['user'=>$user]);
    }

    public function postsua(Request $request,$id){
        $user = user::find($id);
        $this->validate($request,[

                'name'=>'required|min:3|max:100'

        ],[
                 'name.required'=>'Ban chưa nhập tên nguoi dung',
                 
                 'name.min'=>'Tên nguoi dung có độ dài từ 2 đến 100 kí tự',
                 'name.max'=>'Tên nguoi dung có độ dài từ 2 đến 100 kí tự'

        ]);

        $user->name =$request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return redirect('admin/user/sua/'.$id)->with('thongbao','Sửa thành công');

    }

    public function xoa($id){
        $user = user::find($id);
        $user->delete();
         return redirect('admin/user/danhsach')->with('thongbao','Xóa thành công nguoi dung:'.' '.$user->name);
    }
}
