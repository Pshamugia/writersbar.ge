<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function gallery()
        {

        //$images = DB::table('gallery_files')->where('gallery_id', 36)->get();
        //dd($images);

        $categories = Categories::orderBy('position', 'desc')->get();
            $gallery = Gallery::orderBy('year', 'DESC')->paginate(9);
            return view('gallery', ['gallery' => $gallery, 'categories'=>$categories]);

         }


         public function index()
{
        return view('admin.gallery.index');
}




}
