<?php

namespace App\Http\Controllers;

use File;
use App\Models\Gallery;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class GalleriesController extends Controller
{
    public function events($category_id)
    {

        $categories = Categories::orderBy('position', 'desc')->get();
        $gallery = Gallery::orderBy('id', 'DESC')->get();
        return view('gallery', ['gallery' => $gallery, 'categories' => $categories]);

    }


    public function index()
    {
        if ( (Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }
        $categories = Categories::all();
        $gallery = Gallery::orderBy('id', 'DESC')->paginate(
            5);
        $hash = md5(time());

        return view('admin.gallery.photo.index', ['gallery' => $gallery, 'categories' => $categories, 'hash' => $hash]);
    }



    public function add()
{
    if ( (Auth::user() && ((int)(Auth::user()->type) !== 0))) {
        return redirect()->route('admin.login');
    }
    $hash = md5(time());
    $gallery = Gallery::orderBy('id', 'ASC')->get();
    $categories = categories::orderBy('name_ka', 'ASC')->get();
    return view('admin/gallery/photo/add', ['gallery' => $gallery, 'categories' => $categories, 'hash'=>$hash]);
}

    public function upload(Request $request)
    {
        $hash = $request->hash;
        $name = $request->file('qqfile')->store('tmp_uploads');
        if ($name) {
            DB::table('tmp_uploads')->insert([
                'path' => 'app/' . $name,
                'hash' => $hash,
                'created_at' => now()
            ]);

            return response()->json([
                'success' => true
            ]);
        }
    }

    public function store(Request $request)
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
            })->save(public_path('uploads/' . $myimage));

            //$myimage = $request->upload->getClientOriginalName();
            //$request->upload->move(public_path('uploads'), $myimage);

            $filename = 'uploads/' . $myimage;
        }

        $hash = $request->hash;
        $art = Gallery::make();
        $art->title = $request->title;
        $art->year = $request->year;
        $art->upload1 = $filename;
        $art->save();

        $tmp_uploads = DB::table('tmp_uploads')->where('hash', $hash)->get();

        foreach ($tmp_uploads as $upload) {

            $imgFile = Image::make(storage_path($upload->path));
            $imgFile->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($upload->path));

            //File::move(storage_path($upload->path), public_path($upload->path));
            DB::table('gallery_files')->insert(
                [
                    'gallery_id' => $art->id,
                    'upload' => $upload->path

                ]
            );
        }
        DB::table('tmp_uploads')->where('hash', $hash)->delete();
        return redirect()->route('admin.gallery.photo');
    }


    public function full_gallery($title, $id)
    {
        $categories = Categories::orderBy('position', 'desc')->get();

        $gallery = Gallery::where('id', $id)->select(
            'title',
            'upload1'
        )->first();
        $images = DB::table('gallery_files')->where('gallery_id', $id)->get();


        return view('/full_gallery', ['images' => $images, 'gallery'=>$gallery, 'categories'=>$categories]);

    }



    public function delete($id)
    {
        if ( (Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }
        Gallery::where('id', $id)->delete();
        $images = DB::table('gallery_files')->where('gallery_id', $id)->get();

        return redirect()->route('admin.gallery.photo', ['images'=>$images]);
    }


    public function edit($id)

    {
        if ( (Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }
        $gallery = Gallery::where('id', $id)->first();
        $images = DB::table('gallery_files')->where('gallery_id', $id)->get();
        $hash = md5(time());
        return view('admin.gallery.photo.edit', ['gallery'=>$gallery, 'images'=>$images, 'hash'=>$hash]);

    }

    public function admin_gallery_photo_update (Request $request, $id)
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
        $hash = $request->hash;
        $art = Gallery::where('id', $id)->first();
        $art->title = $request->title;
        $art->year = $request->year;
        if (!empty($filename)) {
            $art->upload1=$filename;
        }
        $art->save();

        if(is_array($request->images))
        {
            foreach($request->images as $img)
            {
                DB::table('gallery_files')->where('id', $img)->delete();
            }
        }

        $tmp_uploads = DB::table('tmp_uploads')->where('hash', $hash)->get();

        foreach ($tmp_uploads as $upload) {
            $imgFile = Image::make(storage_path($upload->path));
            $imgFile->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($upload->path));
            //File::move(storage_path($upload->path), public_path($upload->path));
            DB::table('gallery_files')->insert(
                [
                    'gallery_id' => $art->id,
                    'upload' => $upload->path

                ]
            );
        }
        DB::table('tmp_uploads')->where('hash', $hash)->delete();
        return redirect()->route('admin.gallery.photo');
    }




    public function gallery()
    {

    //$images = DB::table('gallery_files')->where('gallery_id', 36)->get();
    //dd($images);

    $categories = Categories::orderBy('position', 'desc')->get();
        $gallery = Gallery::orderBy('year', 'DESC')->paginate(9);
        return view('gallery', ['gallery' => $gallery, 'categories'=>$categories]);

     }




}
