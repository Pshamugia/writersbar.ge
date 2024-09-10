<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Avtorebi;
use App\Models\Banner;
use Illuminate\Http\Request;
use App\Models\KulturaCxrili;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $menu = Menu::where('title_ka', '=', 'განცხადებები')
            ->orWhere('title_ka', '=', 'ღონისძიებები')
            ->orderBy('id', 'desc')
            ->first();

        $announcements = KulturaCxrili::where('kategory', 'LIKE', '%' . $menu->id . '|%')
            ->where('satauri_ka', '!=', '')
            ->orderBy('news_date', 'desc')
            ->skip(0)
            ->take(3)
            ->get();


        $slider = KulturaCxrili::where('subkat', '=', 'yes')
            ->where('hidden', '=', '0')
            ->where('satauri_ka', '!=', '')
            ->orderBy('news_date', 'desc')
            ->take(1)
            ->first();

        $slider2 = KulturaCxrili::where('subkat', '=', 'yes')
            ->where('hidden', '=', '0')
            ->where('satauri_ka', '!=', '')
            ->orderBy('news_date', 'desc')
            ->skip(1)
            ->take(2)
            ->get();

        $menuBlogs = Menu::where('title_ka', 'ბლოგები')->first();
        $blogs = KulturaCxrili::where('kategory', 'LIKE', '%' . $menuBlogs->id . '|%')
            ->where('satauri_ka', '!=', '')
            ->where('hidden', '0')
            ->orderBy('news_date', 'desc')
            ->take(3)
            ->get();
        /*
        $newBlogs = [];
        foreach($blogs as $blog) {

            $newBlogs[] = [
                'id' => $blog->id,
                'upload'=>$blog->upload,
                'satauri_ka'=>$blog->satauri_ka,
                'title_ka'=>Menu::where('id', $blog->kategory)->value('title_ka'),
                'blogsAuthor'=>Avtorebi::where('id', $blog->avtori)->value('avtori')
            ];
        }*/



        $menuMultimedia = Menu::where('title_ka', 'ვიდეო')->first();
        $multimedia = KulturaCxrili::where('kategory', 'LIKE', '%' . $menuMultimedia->id . '|%')
            ->orWhere('kategory', 'ვიდეო|')
            ->orderBy('id', 'desc')
            ->take(3)
            ->get();


        $news1 = KulturaCxrili::where('hidden', '0')
            ->where('satauri_ka', '!=', '')
            ->orderBy('news_date', 'desc')
            ->take(3)
            ->get();

        $statements1 = [];
        foreach ($news1 as $newsOne) {

            $statements1[] = [
                'id' => $newsOne->id,
                'satauri_ka' => $newsOne->satauri_ka,
                'title_ka' => Menu::where('id', $newsOne->kategory)->value('title_ka'),
                'upload' => $newsOne->upload

            ];
        }

        $news2 = KulturaCxrili::where('hidden', '0')
            ->where('satauri_ka', '!=', '')
            ->orderBy('news_date', 'desc')
            ->skip(3)
            ->take(3)
            ->get();

        $statements2 = [];
        foreach ($news2 as $newsTwo) {

            $statements2[] = [
                'id' => $newsTwo->id,
                'satauri_ka' => $newsTwo->satauri_ka,
                'title_ka' => Menu::where('id', $newsTwo->kategory)->value('title_ka'),
                'upload' => $newsTwo->upload

            ];
        }





        return view('index', [
            'announcements' => $announcements,
            'slider' => $slider,
            'slider2' => $slider2,
            'blogs' => $blogs,
            'multimedia' => $multimedia,
            'statements1' => $statements1,
            'statements2' => $statements2
        ]);
    }

    public function full($title, $id)
    {
        $full = KulturaCxrili::where('id', $id)->first();

        if ($full->satauri_ka == '')
            return redirect()->route('index.index');

            $relatedTopQuery = KulturaCxrili::where('kategory', $full->kategory)
            ->where('id', '!=', $full->id)
            ->where('hidden', 0)
            ->where('satauri_ka', '!=', '')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        KulturaCxrili::where('id', $id)
            ->update(['view_count' => $full->view_count + 1]);

            $banners = Banner::where('kategory', 'banner1')
            ->orWhere('kategory', 'banner2')
            ->orWhere('kategory', 'banner3')
            ->orWhere('kategory', 'banner4')
            ->orWhere('kategory', 'banner5')
            ->orderBy('kategory', 'desc')
            ->get();


        return view('full', [
            'full' => $full,
            'relatedTopQuery'=>$relatedTopQuery,
            'banners'=>$banners
        ]);
    }

    public function fullAuthor($author, $id){
 
        $author = Avtorebi::where('id', $id)
        ->first();   
        $full_author2 = KulturaCxrili::where('avtori', $id)
        ->where('satauri_ka', '!=', '')
        ->get();   



        return view('full_author', [
            'author' => $author,
            'full_author2' => $full_author2      

        ]); 
    }

    





    public function contact(){

        return view('contactme', []);
        
    }


    
}
