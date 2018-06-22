<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tintuc;
use App\loaitin;
use App\theloai;
use App\comment;
class Controller_tintuc extends Controller
{
    //
    public function danhsach(){
        $tintuc = tintuc::all();
    	return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);

    }

    
    public function them(){
        $theloai = theloai::all();
        $loaitin = loaitin::all();
       
        return view('admin.tintuc.them',['theloai'=>$theloai],['loaitin'=>$loaitin]);
    }
     public function postthem(Request $request){
        $this->validate($request,[
              'loaitin'=>'required',
              'TieuDe'=>'required|min:3|unique:tintuc,TieuDe',
              'TomTat'=>'required|min:3|unique:tintuc,TomTat',
              'NoiDung'=>'required|min:3|unique:tintuc,NoiDung'

        ],[
             'loaitin.required'=>'Bạn chưa nhập loại tin',
             'TieuDe.required'=> 'Bạn chưa nhập tiêu đề',
             'TieuDe.min'=>'Tên tiêu đề quá ngắn',
             'TomTat.unique'=>'Tên tóm tắt bị trùng',
             'TomTat.required'=> 'Bạn chưa nhập tóm tắt',
             'TomTat.min'=>'Tên tóm tắt quá ngắn',
             'TomTat.unique'=>'Tên tóm tắt bị trùng',
             'NoiDung.required'=> 'Bạn chưa nhập nội dung',
             'NoiDung.min'=>' Nội dung quá ngắn',
             'NoiDung.unique'=>' Nội dung bị trùng',

        ]);

        $tintuc = new tintuc;
        $tintuc->TieuDe =$request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->loaitin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0;
        if ($request->hasFile('Hinh')) {

            # code...
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi !='jpeg'){
                  return redirect('admin/tintuc/them')->with('loi','Bạn chỉ được chọn file jpg ,png,jpeg');
            }
            $name = $file -> getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while(file_exists("upload/tintuc/".$Hinh)){
                 $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/tintuc",$Hinh);
            $tintuc->Hinh = $Hinh;
           
        }else
        {
           $tintuc->Hinh = "";
        }
        $tintuc->save();

        
       return redirect('admin/tintuc/them')->with('thongbao','Thêm thành công');
    }
    
    public function sua($id){
     
        $theloai = theloai::all();
        $loaitin = loaitin::all();
        $tintuc = tintuc::find($id);
        return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
       
    }

    public function postsua(Request $request,$id){
          $tintuc = tintuc::find($id);
          $this->validate($request,[
              'loaitin'=>'required',
              'TieuDe'=>'required',
              'TomTat'=>'required',
              'NoiDung'=>'required'

        ],[
             'loaitin.required'=>'Bạn chưa nhập loại tin',
             'TieuDe.required'=> 'Bạn chưa nhập tiêu đề',
             
             
             'TomTat.required'=> 'Bạn chưa nhập tóm tắt',
            
             'NoiDung.required'=> 'Bạn chưa nhập nội dung'
            

        ]);

        $tintuc->TieuDe =$request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->loaitin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0;
        if ($request->hasFile('Hinh')) {

            # code...
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi !='jpeg'){
                  return redirect('admin/tintuc/them')->with('loi','Bạn chỉ được chọn file jpg ,png,jpeg');
            }
            $name = $file -> getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while(file_exists("upload/tintuc/".$Hinh)){
                 $Hinh = str_random(4)."_".$name;
            }
            $file->move("upload/tintuc",$Hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
           
        }
       
        $tintuc->save();

        
       return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Sửa thành công');
    } 


    public function xoa($id){
        $tintuc = tintuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao','Xóa thành công');
    }
}

