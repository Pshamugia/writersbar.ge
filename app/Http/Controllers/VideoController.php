<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class VideoController extends Controller
{
    public function view()
    {

        if ((Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }
        $video = Video::orderBy('id', 'DESC')->paginate(
            5
        );
        $hash = md5(time());

        return view('admin.gallery.video.index', ['video' => $video, 'hash' => $hash]);
    }


    public function video_view()
    {

        $categories = Categories::orderBy('position', 'desc')->get();

        $video = Video::orderBy('id', 'DESC')->paginate(10);


        return view('video', ['video' => $video, 'categories' => $categories]);
    }


    public function full_video($title_ka, $id)
    {
        $categories = Categories::orderBy('position', 'desc')->get();

        $video = Video::where('id', $id)->select(
            'title_ka',
            'upload',
            'description_ka'
        )->first();


        return view('/full_video', ['video' => $video, 'categories' => $categories]);
    }

    public function add()
    {

        return view('admin.gallery.video.add');
    }



    public function store(Request $request)
    {
        if ((Auth::user() && ((int)(Auth::user()->type) !== 0))) {
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

        $art = Video::make();
        $art->title_ka = $request->title_ka;
        $art->description_ka = $request->description_ka;
        $art->created_at = $request->created_at;
        $art->video_id = 0;
        $art->upload = $filename;
        $art->save();

        return redirect()->route('admin.gallery.video');
    }



    public function edit($id)

    {
        if ((Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }
        $video = Video::where('id', $id)->first();

        return view('admin.gallery.video.edit', ['video' => $video]);
    }


    public function admin_gallery_video_update(Request $request, $id)
    {
        if ((Auth::user() && ((int)(Auth::user()->type) !== 0))) {
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

        $art = Video::where('id', $id)->first();
        $art->title_ka = $request->title_ka;
        $art->title_ka = $request->title_ka;
        $art->description_ka = $request->description_ka;
        $art->created_at = $request->created_at;
        $art->video_id = 0;

        if (!empty($filename)) {
            $art->upload = $filename;
        }
        $art->save();

        return redirect()->route('admin.gallery.video', ['art' => $art]);
    }


    public function delete($id)
    {
        if ((Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }
        Video::where('id', $id)->delete();

        return redirect()->route('admin.gallery.video');
    }
}
