<?php

namespace App\Http\Controllers;

use App\Models\KulturaCxrili;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index(Request $request)
    {
        $query = KulturaCxrili::where('kategory', '!=', 'ფოტო')->where('kategory', '!=', 'ვიდეო')->where('kategory', '!=', 'images');

        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        $results = $query->orderBy('id', 'DESC')->paginate(10);

        return view('admin/index', ['results' => $results]);
    }
    public function show($id)
    {
        KulturaCxrili::where('id', $id)->update([
            'hidden' => 0
        ]);

        return redirect()->route('admin.index');
    }
    public function hide($id)
    {
        KulturaCxrili::where('id', $id)->update([
            'hidden' => 1
        ]);
        return redirect()->route('admin.index');
    }
    public function edit($id)
    {

        return view('admin/update');
    
    }
    
}
