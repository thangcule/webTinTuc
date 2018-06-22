<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\slide;
class Controller_slide extends Controller
{
    //
    public function danhsach(){
    	$slide = slide::all();
        return view('admin.slide.danhsach',['slide'=>$slide]);
     
    }

    public function sua(){
    	return view('admin.slide.sua');
    }

    public function them(){

        return view('admin.slide.them');
    }
    public function postthem(Request $request){
        $this->validate($request,[
            'Ten'=>'required',
            'NoiDung'=>'required'
        ],[
            'Ten.required'=>'Bạn chưa nhập tên',
            'NoiDung.required'=>'Bạn chưa có nội dung'
        ]);
        $slide = new slide;
     
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        
         if($request->has('link'))
             $slide->link = $request->link;
        
       if ($request->hasFile('Hinh')) {

            # code...
            $file = $request->file('Hinh');
            // $duoi = $file->getClientOriginalExtension();
            // if($duoi != 'jpg' && $duoi != 'png' && $duoi !='jpeg'){
            //       return redirect('admin/slide/them')->with('loi','Bạn chỉ được chọn file jpg ,png,jpeg');
            // }
            // $name = $file -> getClientOriginalName();
            // $Hinh = str_random(4)."_".$name;
            // while(file_exists("upload/slide/".$Hinh)){
            //      $Hinh = str_random(4)."_".$name;
            // }
            $file->move("upload/silde");
            $slide->Hinh = $file;
           
         }else
        {
            $slide->Hinh = "";
         }
        $slide->save();
        return redirect('admin/slide/them')->with('thongbao','Thêm thành công');

    }
}

