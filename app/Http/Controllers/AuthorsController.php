<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Categories;
use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorsController extends Controller
{

    public function fullAuthor($author_ka, $id)
    {
        $categories = Categories::all();
        $authors = authors::select([
            'author_ka'
        ])->
            where('id', $id)
            ->first();

        $full = Articles::where('author_id', $id)
            ->select(
                [
                    'id',
                    'title_ka',
                    'title_en',
                    'full_ka',
                    'full_en',
                    'author_id',
                    'description_ka',
                    'description_en',
                    'category_id',
                    'upload',
                    'view_count'
                ]
            )->first();

        $event = Articles::where('author_id', $id)->orderBy('year', 'DESC')->get();


        $full_author = Authors::
            select([
                'id',
                'author_ka',
                'Author_en'
            ])->get();

        return view('fullAuthor', [
            'categories' => $categories,
            'full_author' => $full_author,
            'authors' => $authors,
            'full' => $full,
            'event' => $event
        ]);

    }

    public function index()
    {

        $authors = Authors::select([
            'id',
            'author_ka',
        'author_en'])->get();

        $categories = Categories::all();
        return view('admin.authors.index', [
            'categories' => $categories,
        'authors' => $authors]);

    }


    public function add()
    {
        if ((Auth::user() && ((int) (Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }
        return view('admin.authors.add');

    }



    public function store(Request $request)
    {
        if ((Auth::user() && ((int) (Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }
        $author = Authors::make();
        $author->author_ka = $request->author_ka;
        $author->author_en = $request->author_en;
        $author->save();

        return redirect()->route('admin.authors');
    }


    public function author_delete(Request $request)
    {
         if ( (Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }

        if($request->has('delete_btn'))
        {

        Authors::where('id', $request->authors_id)->delete();

        return redirect()->route('admin.authors');
        }

        else if($request->has('edit_btn'))
        {
            $author = Authors::where('id', $request->authors_id)->first();
            return view('admin.authors.edit', ['author'=>$author]);
        }

   }

   public function author_update ($id, Request $request)
   {

    Authors::where('id', $id)->update([
        'author_ka'=> $request->author_ka,
        'author_en'=> $request->author_en,
    ]);

    return redirect()->route('admin.authors');

}

}
