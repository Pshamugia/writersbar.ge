<?php

namespace App\Http\Controllers;

use App\Models\Avtorebi;
use Illuminate\Http\Request;
use App\Models\KulturaCxrili;

class SearchController extends Controller
{
    public function searchpage(Request $request)
    {
        $query = null;
        if (isset($request->tag))
        {
            $query = KulturaCxrili::where(function ($q1) use ($request)
            {
                $q1->where('tags_geo', 'LIKE', '%'.$request->tag.'%')
            ->orWhere('tags_eng', 'LIKE', '%'.$request->tag.'%');
            });
         }

        if (isset($request->text) && !empty($request->text)) {
            $query = KulturaCxrili::where(function ($q) use($request) {
                $q->where('agwera_ka', 'LIKE', '%' . $request->text . '%')
                    ->orWhere('satauri_ka', 'LIKE', '%' . $request->text . '%')
                    ->orWhere('tags_geo', 'LIKE', '%' . $request->text . '%')
                    ->orWhere('tags_eng', 'LIKE', '%' . $request->text . '%')
                    ->orWhere('full_ka', 'LIKE', '%' . $request->text . '%');
                    
                    $avtorebi=Avtorebi::where('avtori', 'LIKE', '%' . $request->text . '%')->get();                    

                    foreach($avtorebi as $avtori)
                    {
                        $q->orWhere('avtori', $avtori->id);
                    }

            })
                ->Where('hidden', 0)
                ->where('satauri_ka', '!=', '');
        }

        $results=[];
        if($query) {
            $results = $query->paginate(20);
        }

        return view('search', [
            'results' => $results,
            'keyword' => $request->text

        ]);
    }
}
