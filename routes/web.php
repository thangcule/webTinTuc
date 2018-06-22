<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\theloai;
Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/dangnhap','Controller_user@dangnhapAdmin');
Route::post('admin/dangnhap','Controller_user@postdangnhapAdmin');
Route::get('admin/dangxuat','Controller_pages@dangxuatAdmin');

Route::group(['prefix'=>'admin'],function(){

        Route::group(['prefix'=>'theloai'],function(){
       	//admin/theloai/danhsach
           Route::get('danhsach','Controller_theloai@danhsach');
           Route::get('them','Controller_theloai@them');
           Route::post('them','Controller_theloai@postthem');
           Route::get('sua/{id}','Controller_theloai@sua');
           Route::post('sua/{id}','Controller_theloai@postsua');
           Route::get('xoa/{id}','Controller_theloai@xoa');
       });


        Route::group(['prefix'=>'loaitin'],function(){
       	//admin/loaitin/danhsach
           Route::get('danhsach','Controller_loaitin@danhsach');
           Route::get('them','Controller_loaitin@them');
           Route::post('them','Controller_loaitin@postthem');
           Route::get('sua/{id}','Controller_loaitin@sua');
           Route::post('sua/{id}','Controller_loaitin@postsua');
           Route::get('xoa/{id}','Controller_loaitin@xoa');
       });


        Route::group(['prefix'=>'tintuc'],function(){
       	//admin/tintuc/danhsach
           Route::get('danhsach','Controller_tintuc@danhsach');
     
           Route::get('them','Controller_tintuc@them');
           Route::post('them','Controller_tintuc@postthem');
           Route::get('sua/{id}','Controller_tintuc@sua');
           Route::post('sua/{id}','Controller_tintuc@postsua');
           Route::get('xoa/{id}','Controller_tintuc@xoa');
       });


        Route::group(['prefix'=>'comment'],function(){
       	//admin/comment/danhsach
          
           Route::get('xoa/{id}/{idTinTuc}','Controller_comment@xoa');
          
       });


        Route::group(['prefix'=>'slide'],function(){
       	//admin/slide/danhsach
           Route::get('danhsach','Controller_slide@danhsach');
           Route::get('sua','Controller_slide@sua');
           Route::get('them','Controller_slide@them');
            Route::post('them','Controller_slide@postthem');
       });


        Route::group(['prefix'=>'user'],function(){
       	//admin/user/danhsach
           Route::get('danhsach','Controller_user@danhsach');
           Route::get('sua/{id}','Controller_user@sua');
            Route::post('sua/{id}','Controller_user@postsua');
           Route::get('them','Controller_user@them');
           Route::post('them','Controller_user@postthem');
           Route::get('xoa/{id}','Controller_user@xoa');
       });
        Route::group(['prefix'=>'ajax'],function(){

           Route::get('loaitin/{idTheLoai}','Controller_Ajax@getloaitin');     
        });
});


Route::get('trangchu','Controller_pages@trangchu');
Route::get('lienhe','Controller_pages@lienhe');
Route::get('loaitin/{id}/{TenKhongDau}.html','Controller_pages@loaitin');
Route::get('tintuc/{id}/{TieuDeKhpngDau}','Controller_pages@tintuc');
Route::get('dangnhap','Controller_pages@dangnhap');
Route::post('dangnhap','Controller_pages@postdangnhap');
Route::get('dangxuat','Controller_pages@dangxuat');
Route::get('nguoidung','Controller_pages@nguoidung');
Route::post('nguoidung','Controller_pages@postnguoidung');
Route::get('dangky','Controller_pages@dangky');
Route::post('dangky','Controller_pages@postdangky');

Route::post('comment/{id}','Controller_comment@postcomment');

Route::get('search',[
  'as'=>'search',
  'uses'=>'Controller_pages@search']);