<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Gallery;
use App\Models\Articles;
use App\Models\Category;
use App\Models\Categories;
use App\Models\ContactEmail;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Models\Quizz;
use App\Models\Video;

class ArticlesController extends Controller
{


    public function welcome(Request $request)
    {



        $categories = Categories::orderBy('position', 'desc')->get();



        $root_zero = Categories::where('root_id', '0')->orderBy('position', 'ASC')->get();

        $root_main = Categories::where('root_id', '0')->orderBy('position', 'ASC')->first();

        $root_id = Categories::where('root_id', $root_main->id)->orderBy('position', 'ASC')->get();



        $about = Articles::select([
                'category_id',
                'title_ka',
                'title_en',
                'description_ka',
                'description_en'
            ])->join('categories', 'articles.category_id', 'categories.id')
            ->where('articles.category_id', '5')
            ->get();


        $bestseller = Articles::select([
                'category_id',
                'title_ka',
                'title_en',
                'upload',
                'year',
                'description_ka',
                'description_en'
            ])->join('categories', 'articles.category_id', 'categories.id')
            ->where('articles.category_id', '7')
            ->orderBy('year', 'DESC')
            ->limit(9)
            ->get();


        $search = Articles::where('title_ka', 'LIKE', '%' . $request->text . '%')
            ->orWhere('full_ka', 'LIKE', '%' . $request->text . '%')->get();

        $articles = Articles::where('subkat', 'yes')
            ->orderBy('year', 'DESC')
            ->select(
                [
                    'id',
                    'title_ka',
                    'title_en',
                    'subkat',
                    'category_id',
                    'full_ka',
                    'full_en',
                    'description_ka',
                    'description_en',
                    'upload',
                    'year'
                ]
            )

            ->offset(0)->limit(3)->get(); // ეს paginate არის პაგინაციის სკრიპტი სულ და მერე გამოგვაქვს ამით $rame->links(). paginate(2) ეს ლიმიტის რიცხვია.

        return view('welcome', [
            'articles' => $articles,
            'categories' => $categories,
            'about' => $about,
            'bestseller' => $bestseller,
            'search' => $search,
            'root_zero' => $root_zero,
            'root_id' => $root_id,
            'root_main' => $root_main
        ]);
    }



    public function privacy (Request $request)
    {

        $categories = Categories::orderBy('position', 'desc')->get();

        return view('privacy', ['categories' => $categories]);
    }

    public function terms (Request $request)
    {

        $categories = Categories::orderBy('position', 'desc')->get();

        return view('terms', ['categories' => $categories]);
    }



    public function full($title_ka, $id)
    {


        $categories = Categories::orderBy('position', 'desc')->get();

 
        $authors = Articles::select([
                'category_id',
                'title_ka',
                'title_en',
                'author_id',
                'description_ka',
                'description_en'
            ])->join('authors', 'articles.author_id', 'authors.id')
            ->where('articles.author_id', 'authors.id')
            ->first();



        $full_author = Authors::select([
                'id',
                'author_ka',
                'Author_en'
            ])->first();



        $full = Articles::where('id', $id)
            ->select(
                [
                    'id',
                    'title_ka',
                    'title_en',
                    'full_ka',
                    'full_en',
                    'tags_ka',
                    'tags_en',
                    'author_id',
                    'description_ka',
                    'description_en',
                    'category_id',
                    'upload',
                    'view_count'
                ]
            )->first();

        if (app()->isLocale('ka') && empty($full->title_ka)) {
            return redirect()->route('welcome');
        }
        if (app()->isLocale('en') && empty($full->title_en)) {
            return redirect()->route('welcome');
        }

        Articles::where('id', $id)
            ->update(['view_count' => $full->view_count + 1]);


        $event = Articles::where('id', $id)->orderBy('year', 'DESC')->get();


        $cat = Articles::where('id', $id)->first();

        $related = Articles::where('id', '!=', $id)
            ->where('category_id', $cat->category_id)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();



        $related2 = Articles::where('id', '!=', $id)
            ->where('category_id', $cat->category_id)
            ->orderBy('id', 'desc')
            ->take(1)
            ->get();

        return view('full', [
            'full' => $full,
            'categories' => $categories,
            'event' => $event,
            'authors' => $authors,
            'full_author' => $full_author,
            'related' => $related,
            'cat' => $cat,
            'related2' => $related2,
            'title_ka' => $title_ka
        ]);
    }

    public function index()
    {

        if ((Auth::user() && ((int) (Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }

        $articles = Articles::orderBy('id', 'desc')
            ->select(
                [
                    'id',
                    'title_ka',
                    'title_en',
                    'subkat',
                    'description_ka',
                    'description_en',
                    'category_id',
                    'full_ka',
                    'full_en',
                    'upload',
                    'expand'
                ]
            )

            ->paginate(10); // ეს paginate არის პაგინაციის სკრიპტი სულ და მერე გამოგვაქვს ამით $rame->links(). paginate(2) ეს ლიმიტის რიცხვია.

        return view('admin/articles/index', ['articles' => $articles]);
    }


    public function events($category_id)
    {

        $categories = Categories::orderBy('position', 'desc')->get();



        $full = Articles::where('category_id', $category_id)
            ->select(
                [
                    'id',
                    'title_ka',
                    'title_en',
                    'full_ka',
                    'full_en',
                    'description_ka',
                    'description_en',
                    'category_id',
                    'upload',
                    'expand'
                ]
            )->first();
        $quizz_view = Quizz::where('hidden', '0')->orderBy('id', 'DESC')->get();

        $video = Video::orderBy('id', 'DESC')->get();

        $event = Articles::where('category_id', $category_id)->orderBy('year', 'DESC')->get();

        $quizz_time = Quizz::orderBy('created_at', 'DESC')->get();


        return view('events', [
            'event' => $event,
            'categories' => $categories,
            'full' => $full,
            'quizz_view' => $quizz_view,
            'quizz_time' => $quizz_time,
            'video' => $video
        ]);
    }




    public function search(Request $request)
    {


        $categories = Categories::orderBy('position', 'desc')->get();

        $full = Articles::where('id', $request->id)
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






        if (isset($request->text) && !empty($request->text)) {
            $search = Articles::where('title_ka', 'LIKE', '%' . $request->text . '%')
                ->orWhere('full_ka', 'LIKE', '%' . $request->text . '%')
                ->orWhere('full_en', 'LIKE', '%' . $request->text . '%')
                ->orWhere('title_en', 'LIKE', '%' . $request->text . '%')
                ->orWhere('tags_ka', 'LIKE', '%' . $request->text . '%')
                ->orWhere('tags_en', 'LIKE', '%' . $request->text . '%')
                ->orderBy('year', 'DESC')->get();

            $search_gallery = Gallery::where('title', 'LIKE', '%' . $request->text . '%')
                ->orderBy('year', 'DESC')->get();

                $search_video = Video::where('title_ka', 'LIKE', '%' . $request->text . '%')
                ->orderBy('created_at', 'DESC')->get();

                $search_tags = Articles::where('tags_ka', 'LIKE', '%' . $request->tag . '%')
                ->orWhere('tags_en', 'LIKE', '%' . $request->tag . '%')
                ->get();

            $count1 = $search->count();
            $count2 = $search_gallery->count();
            $count3 = $search_video->count();

        }
        return view('search', [
            'search' => $search,
            'search_gallery' => $search_gallery,
            'search_video' => $search_video,
            'search_tags' => $search_tags,
            'categories' => $categories,
            'count1' => $count1,
            'count2' => $count2,
            'count3' => $count3,
            'full' => $full
        ]);
    }


    public function search_admin(Request $request)
    {


        $categories = Categories::all();
        $searchQuery = Articles::orderBy('year', 'DESC');
        $search_galleryQuery = Gallery::orderBy('year', 'DESC');
        if (isset($request->text) && !empty($request->text)) {
            $searchQuery->where('title_ka', 'LIKE', '%' . $request->text . '%')
                ->orWhere('full_ka', 'LIKE', '%' . $request->text . '%');
            $search_galleryQuery->where('title', 'LIKE', '%' . $request->text . '%');
        }

        if (!empty($request->from_date)) {
            $searchQuery->whereDate('year', '>=', Carbon::parse($request->from_date));
            $search_galleryQuery->whereDate('year', '>=', Carbon::parse($request->from_date));
        }

        if (!empty($request->to_date)) {
            $searchQuery->whereDate('year', '<=', Carbon::parse($request->to_date));
            $search_galleryQuery->whereDate('year', '<=', Carbon::parse($request->to_date));
        }

        $search = $searchQuery->get();
        $search_gallery = $search_galleryQuery->get();

        $count1 = $search->count();
        $count2 = $search_gallery->count();


        return view('admin/search/search_admin', [
            'search' => $search,
            'search_gallery' => $search_gallery,
            'categories' => $categories,
            'count1' => $count1,
            'count2' => $count2
        ]);
    }


    public function projects()
    {
        $project = Articles::orderBy('id', 'ASC')->get();
        return view('projects', ['project' => $project]);
    }


    public function add()
    {
        if ((Auth::user() && ((int) (Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }
        $articles = Articles::orderBy('title_ka', 'ASC')->get();
        $full_author = Authors::all();
        $categories = categories::orderBy('name_ka', 'ASC')->get();
        return view('admin/articles/add', [
            'articles' => $articles,
            'categories' => $categories,
            'full_author' => $full_author
        ]);
    }

    public function full_add()
    {
        $categories = Categories::orderBy('name_ka', 'ASC')->get();
        return view('full', ['categories' => $categories]);
    }




    public function store(Request $request)
    {
        $filename = '';
        if ($request->has('upload')) {
            $myimage = $request->upload->getClientOriginalName();
            $imgFile = Image::make($request->upload->getRealPath());
            $imgFile->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/' . $myimage));

            //$myimage = $request->upload->getClientOriginalName();
            //$request->upload->move(public_path('uploads'), $myimage);

            $filename = 'uploads/' . $myimage;
        }

        $art = Articles::make();
        $art->title_ka = $request->title_ka;
        $art->title_en = $request->title_en;
        $art->subkat = $request->subkat;
        $art->description_ka = $request->description_ka;
        $art->description_en = $request->description_en;
        $art->full_ka = $request->full_ka;
        $art->full_en = $request->full_en;
        $art->category_id = $request->category_id;
        $art->author_id = $request->author_id;
        $art->year = $request->year;
        $art->tags_ka = $request->tags_ka;
        $art->tags_en = $request->tags_en;
        $art->upload = $filename;
        $art->expand = $request->expand;
        $art->save();


        return redirect()->route('admin.article');
    }



    public function contact(Request $request)
    {
        $data = [
            'name' => $request->name,
            'subject' => $request->subject,
            'messageText' => $request->message,
            'email' => $request->email
        ];
        Mail::to('meetme@writersbar.ge')->send(new ContactEmail($data));
        return 'Your email has been sent';
    }



}
