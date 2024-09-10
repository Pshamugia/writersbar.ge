<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        if ((Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }


        if (request()->has('hide'))

        Categories::where('id', $request->id)->update([
            'check' => 1
        ]);

    if (request()->has('show'))

    Categories::where('id', $request->id)->update([
            'check' => 0
        ]);

        if (request()->has('down'))
        {
            $down = Categories::where('id', request()->down)->first();
            $up = Categories::where('position', '<', $down->position)->where('root_id', request()->id)->orderBy('position', 'DESC')->first();

            if ($down && $up)
            {
                Categories::where('id', $down->id)->update(['position'=>$up->position]);
                Categories::where('id', $up->id)->update(['position'=>$down->position]);
            }
        }


        if (request()->has('up'))
        {
            $up = Categories::where('id', request()->up)->first();
            $down = Categories::where('position', '>', $up->position)->where('root_id', request()->id)->orderBy('position', 'ASC')->first();

            if ($down && $up)
            {
                Categories::where('id', $down->id)->update(['position'=>$up->position]);
                Categories::where('id', $up->id)->update(['position'=>$down->position]);
            }
        }

        $categories = Categories::orderBy('position', 'DESC')->get();




        if (empty(request()->has('root_id')))
{
        $categories = Categories::where('root_id', '0')->orderBy('position', 'DESC')->get();
}

if (request()->has('root_id'))
{
            $categories = Categories::where('root_id', request()->id)->orderBy('position', 'DESC')->get();

        }


        if (request()->has('addmenu'))
        {
            $categories = Categories::where('id', request()->id)->first();


        $root = Categories::make();

        $root->name_ka = $request->name_ka;
        $root->name_en = $request->name_en;
        $root->check = 0;

        if (request()->has('root_id'))
        {
            $root->root_id = $request->root_id;
            $position = Categories::selectRaw('MAX(position) AS position')->where('root_id', $root->root_id)->first();
            if ($position)
                $position = ((int)$position->position)+1;
            else
                $position = 1;
        }
        else
        {
            $root->root_id = 0;
            $position = Categories::selectRaw('MAX(position) AS position')->where('root_id', 0)->first();
            if ($position)
                $position = ((int)$position->position)+1;
            else
                $position = 1;
        }

        $root->position = $position;

        $root->save();
        return redirect()->route('admin.category.index', ['id' => request()->root_id, 'root_id' => request()->root_id]);
    }

        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    public function add()
    {
        if ((Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }
        return view('admin.category.add');
    }


    public function edit($id)
    {
        if ((Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }
        $cat = Categories::where('id', $id)->first();

        return view('admin.category.edit', ['cat' => $cat]);
    }

    public function update(Request $request, $id)
    {
        if ((Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }

        Categories::where('id', $id)->update([
                'name_ka' => $request->name_ka,
                'name_en' => $request->name_en,
                'check' => $request->check
            ]);

            $root_id = Categories::where('id', $id)->value('root_id');

        return redirect()->route('admin.category.index', ['id' => $root_id, 'root_id' => $root_id]);
    }
    public function store(Request $request)
    {
        if ((Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }

        $position = Categories::selectRaw('MAX(position) AS position')->first();
        if ($position)
            $position = ((int)$position->position)+1;
        else
            $position = 1;

        $art = Categories::make();
        $art->name_ka = $request->name_ka;
        $art->name_en = $request->name_en;
        $art->check = $request->check;
        $art->position = $position;
        $art->save();

        return redirect()->route('admin.category.index');
    }


    public function delete($id)
    {
        if ((Auth::user() && ((int)(Auth::user()->type) !== 0))) {
            return redirect()->route('admin.login');
        }

        $root_id = Categories::where('id', $id)->value('root_id');
        Categories::where('id', $id)
            ->orWhere('root_id',$id)
            ->delete();

            return redirect()->route('admin.category.index', ['id' => $root_id, 'root_id' => $root_id]);
        }
}
