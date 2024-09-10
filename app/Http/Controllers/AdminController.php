<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Articles;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function admin_index ()
    {
        if ( (Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }

        $articles = Articles::orderBy('id', 'asc')
        ->select(
            [
                'id',
                'title_ka',
                'title_en',
                'category_id',
                'year',
                'full_ka',
                'full_en',
                'upload'
            ]
        ); // ეს paginate არის პაგინაციის სკრიპტი სულ და მერე გამოგვაქვს ამით $rame->links(). paginate(2) ეს ლიმიტის რიცხვია.

        return view('admin/articles/index', ['articles' => $articles]);
    }



    public function admin_articles_edit(Request $request, $id)

    {
        if ( (Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }
            $newArticles = Articles::where('id', $id)->first();
            $categories = Categories::all();
            $authors = Articles::
        select([
            'category_id',
            'title_ka',
            'title_en',
            'author_id',
            'description_ka',
            'description_en'
        ])->join('authors', 'articles.author_id', 'authors.id')
        ->where('articles.author_id', 'authors.id')
        ->first();

        $full_author = Authors::all();




        return view('admin.articles.update', [
            'newArticles'=> $newArticles,
            'categories'=>$categories,
        'full_author' => $full_author]);
    }



    public function admin_articles_update(Request $request, $id)
    {

        if ( (Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }

        $filename = '';
        if ($request->has('upload')) {

            $myimage = $request->upload->getClientOriginalName();
            $imgFile = Image::make($request->upload->getRealPath());
            $imgFile->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/'.$myimage));


            //$myimage = $request->upload->getClientOriginalName();
            //$request->upload->move(public_path('uploads'), $myimage);
            $filename = 'uploads/'.$myimage;
        }


            $newArticles = Articles::where('id', $id)->first();
             $newArticles->title_ka=$request->title_ka;
             $newArticles->title_en=$request->title_en;
            $newArticles->category_id=$request->category_id;
            $newArticles->subkat=$request->subkat;
            $newArticles->year=$request->year;
            $newArticles->full_ka=$request->full_ka;
            $newArticles->full_en=$request->full_en;
            $newArticles->expand=$request->expand;
            $newArticles->description_ka=$request->description_ka;
            $newArticles->description_en=$request->description_en;
            $newArticles->tags_ka=$request->tags_ka;
            $newArticles->tags_en=$request->tags_en;


            if (!empty($filename)) {
                $newArticles->upload=$filename;
            }
            $newArticles->save();

        return redirect()->route('admin.article');
    }

    public function delete($id)
    {
        if ( (Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }

        Articles::where('id', $id)->delete();

        return redirect()->route('admin.article');
    }


}
