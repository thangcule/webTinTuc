<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\theloai;
use App\loaitin;

class Controller_Ajax extends Controller
{
    //
    public function getloaitin($idTheLoai){
    	$loaitin = loaitin::where('idTheLoai',$idTheLoai)->get();
    	foreach($loaitin as $lt)
    	{
    		echo "<option value='".$lt->id."'>".$lt->Ten."</option>"; 
    	}

    }
}
