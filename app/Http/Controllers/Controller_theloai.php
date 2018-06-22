<?php
namespace App;
namespace App\Http\Controllers;

use App\theloai;

use Illuminate\Http\Request;

class Controller_theloai extends Controller
{
    //
    public function danhsach(){
    	$theloai = theloai::all(); 
    	return view('admin.theloai.danhsach',['theloai'=> $theloai]);

    }

   

    public function them(){
        return view('admin.theloai.them');
    }
    public function postthem(Request $request){

       // echo $request->Ten;
    	$this->validate($request,
    		[
                'Ten'=>'required|unique:theloai,Ten|min:3|max:100'   	
    	      ],
    	    [
                'Ten.required'=>'Ban chưa nhập tên thể loại',
                'Ten.unique'=>'Tên thể loại đã tồn tại',
                'Ten.min'=>'Tên thể loại có độ dài từ 2 đến 100 kí tự',
                'Ten.max'=>'Tên thể loại có độ dài từ 2 đến 100 kí tự'

    	      ]);
    	$theloai = new theloai;
    	$theloai->Ten =$request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	//echo changeTitle($request->Ten);
    	$theloai->save();
    	return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');

    }

     public function sua($id){
     	$theloai = theloai::find($id);
    	return view('admin.theloai.sua',['theloai'=>$theloai]);
    }

    public function postsua(Request $request,$id){
        $theloai = theloai::find($id);
        $this->validate($request,[

                'Ten'=>'required|unique:theloai,Ten|min:3|max:100'

        ],[
                 'Ten.required'=>'Ban chưa nhập tên thể loại',
                 'Ten.unique'=>'Tên thể loại đã tồn tại',
                 'Ten.min'=>'Tên thể loại có độ dài từ 2 đến 100 kí tự',
                 'Ten.max'=>'Tên thể loại có độ dài từ 2 đến 100 kí tự'

        ]);

        $theloai->Ten =$request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sửa thành công');

    }

    public function xoa($id){
     	$theloai = theloai::find($id);
     	$theloai->delete();
    	 return redirect('admin/theloai/danhsach')->with('thongbao','Xóa thành công thể loại:'.' '.$theloai->Ten);
    }
}

