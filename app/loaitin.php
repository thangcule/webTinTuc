<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loaitin extends Model
{
    //
    protected $table = "loaitin";
    public function theloai(){
    	return $this->belongsto('App\theloai','idTheLoai','id');
    }
    public function tintuc(){
    	return $this->hasMany('App\tintuc','idLoaiTin','id');
    }
}
