<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\comment;
use App\tintuc;
use Illuminate\Support\Facades\Auth;
class Controller_comment extends Controller
{
    //
    public function xoa($id,$idTinTuc){
        $comment = comment::find($id);
        $comment->delete();
        return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbao','Xóa comment thành công');
    }

    public function postcomment($id,Request $request){
    	# code...
    	$idTinTuc = $id;
    	$tintuc = tintuc::find($id);
    	$comment = new comment;
    	$comment->idTinTuc = $idTinTuc;
    	$comment->idUser = Auth::User()->id;
    	$comment->NoiDung = $request->NoiDung;
    	$comment->save();
    	return redirect("tintuc/$id/".$tintuc->TieuDeKhongDau.".html")->with('thongbao','Đã đăng bình luận');
    }
}
