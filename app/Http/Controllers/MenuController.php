<?php

namespace App\Http\Controllers;

use App\Models\KulturaCxrili;
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index($title, $id) {
        //dd($title);
        $menupage = Menu::where('id', '=', $id)->first();
        $menupageKultura = KulturaCxrili::where('kategory', 'LIKE', '%'.$id.'|%')->where('hidden', '0')->first();
       $newsKultura =KulturaCxrili::where('kategory', 'LIKE', '%'.$id.'|%')
       ->where('hidden', '0')
       ->where('satauri_ka', '!=', '')
       ->orderBy('news_date', 'desc')
       ->paginate(12);
 
       $menus = [];

    
        return view('menupage', [
            
            'id'=>$id,
            'menupage'=>$menupage,
            'menupageKultura' => $menupageKultura,
            'newsKultura' => $newsKultura



        ]);
       

        
    }
}
