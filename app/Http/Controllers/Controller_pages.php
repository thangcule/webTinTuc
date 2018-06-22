<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\theloai;
use App\loaitin;
use App\tintuc;
use App\User;
use App\slide;
class Controller_pages extends Controller
{
    //


    function __construct(){
          $theloai = theloai::All();
           $slide = slide::all();
           view()->share('theloai',$theloai);
            view()->share('slide',$slide);

         
          // if(Auth::check()){
          //   view()->share('nguoidung',Auth::User()->name);
          // }

    }
    function trangchu(){
        
             return view('pages.trangchu');
    }

    function lienhe(){
    	 
             return view('pages.lienhe');
    }

    function loaitin($id){
      $loaitin = loaitin::find($id);
      $tintuc = tintuc::where('idLoaiTin',$id)->paginate(5);
      return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }

    function tintuc($id){
      $tintuc = tintuc::find($id);
      $tinnoibat = tintuc::where('NoiBat',1)->take(4)->get();
      $tinlienquan = tintuc::where('idLoaiTin',$id)->take(4)->get();
      return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }

    function dangnhap(){
             return view('pages.dangnhap');
    }
    function postdangnhap(Request $request){

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
            return redirect('trangchu');
          } else {
            return redirect('dangnhap')->with('thongbao','Đăng nhập không thành công');
          }
    }

    function dangxuat(){
      Auth::logout();
      return redirect('trangchu');
    }

    public function nguoidung(){
      $nguoidung = Auth::User();      
      return view('pages.nguoidung',['nguoidung'=>$nguoidung]);
    }
    public function postnguoidung(Request $request){
      $this->validate($request,[
          'name'=>'required|min:3'

      ],[
          'name.required'=>'Bạn chưa nhập tên người dùng',
          'name.min'=>'Tên người dùng từ 3 kí tự trở nên'
      ]);

      $user = Auth::User();
      $user->name = $request->name;
      if ($request->changePassword=="on") {
        $this->validate($request,[
             'password' => 'required|min:3|max:32',
             'passwordAgain'=>'required|same:password'
        ],[
             'password.required'=>'Bạn chưa nhập mật khẩu',
             'password.min'=>'Mật khẩu phải có độ dài từ 3 đến 32 kí tự',
              'password.max'=>'Mật khẩu phải có độ dài từ 3 đến 32 kí tự',
              'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
              'passwordAgain.same'=>'Mật khẩu nhập lại chưa đúng'

        ]);
        $user->password = bcrypt($request->password);
        # code...
      }
      $user->save();
      return redirect('nguoidung')->with('thongbao','Bạn đã sửa thông tin thành công');


    }

    public function dangky(){
        return view('pages.dangky');
    }
    public function postdangky(Request $request){
      $this->validate($request,[
        'name'=>'required|min:3',
        'email'=>'required|min:3',
        'password'=>'required|min:3|max:32',
        'passwordAgain'=>'required|same:password'
      ],[
         'name.required'=>'Bạn chưa nhập tên người dùng',
          'name.min'=>'Tên người dùng từ 3 kí tự trở nên',
          'email.required'=>'Bạn chưa nhập tên người dùng',
          'email.min'=>'Tên người dùng từ 3 kí tự trở nên',
          'password.required'=>'Bạn chưa nhập mật khẩu',
          'password.min'=>'Mật khẩu phải có độ dài từ 3 đến 32 kí tự',
          'password.max'=>'Mật khẩu phải có độ dài từ 3 đến 32 kí tự',
          'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
          'passwordAgain.same'=>'Mật khẩu nhập lại chưa đúng'

      ]);
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->quyen = 0;
      $user->save();
      return redirect('dangky')->with('thongbao','Bạn đã đăng ký thành công !');
    }
     
    public function search(Request $request){
      // $tukhoa = $request->get('tukhoa');
      // $tukhoa = str_replace(' ', '%',$tukhoa);
      $tintuc = tintuc::where('TieuDe','like','%'.$request->key.'%')->orWhere('TomTat','like','%'.$request->key.'%')->orWhere('NoiDung','like','%'.$request->key.'%')->get();

   //return view('pages.search',compact('tintuc'));
      return view('pages.search',['tintuc'=>$tintuc]);
    }

}
