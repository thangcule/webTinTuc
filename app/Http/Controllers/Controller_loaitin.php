<?php
namespace App;
namespace App\Http\Controllers;
use App\theloai;
use App\loaitin;

use Illuminate\Http\Request;

class Controller_loaitin extends Controller
{
    //
    public function danhsach(){
        $loaitin = loaitin::all(); 
        return view('admin.loaitin.danhsach',['loaitin'=> $loaitin]);

    }

   

    public function them(){
        $theloai = theloai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);
    }
    public function postthem(Request $request){

       // echo $request->Ten;
        $this->validate($request,
            [
                'Ten'=>'required|unique:loaitin,Ten|min:3|max:100',
                'theloai'=>'required'      
              ],
            [
                'Ten.required'=>'Ban chưa nhập tên loại tin',
                'Ten.unique'=>'Tên loại tin đã tồn tại',
                'Ten.min'=>'Tên loại tin có độ dài từ 2 đến 100 kí tự',
                'Ten.max'=>'Tên loại tin có độ dài từ 2 đến 100 kí tự',
                'theloai.required'=>'Bạn chưa chọn thể loại'
                
              ]);
        $loaitin = new loaitin;
        $loaitin->Ten =$request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheloai = $request->theloai;
         //echo changeTitle($request->Ten);
        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','Thêm thành công');

    }

     public function sua($id){
        $theloai = theloai::all();
        $loaitin = loaitin::find($id);
        return view('admin.loaitin.sua',['loaitin'=>$loaitin],['theloai'=>$theloai]);
    }

    public function postsua(Request $request,$id){
        $loaitin = loaitin::find($id);
        $this->validate($request,[

                'Ten'=>'required|unique:loaitin,Ten|min:3|max:100'

        ],[
                 'Ten.required'=>'Ban chưa nhập tên loạitin',
                 'Ten.unique'=>'Tên loạitin đã tồn tại',
                 'Ten.min'=>'Tên loạitin có độ dài từ 2 đến 100 kí tự',
                 'Ten.max'=>'Tên loạitin có độ dài từ 2 đến 100 kí tự'

        ]);

        $loaitin->Ten =$request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Sửa thành công');

    }

    public function xoa($id){
        $loaitin = loaitin::find($id);
        $loaitin->delete();
         return redirect('admin/loaitin/danhsach')->with('thongbao','Xóa thành công loạitin:'.' '.$loaitin->Ten);
    }
}


