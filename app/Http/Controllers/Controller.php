<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $savemenu=$this->getMenu(0);
        View::share('mainmenu', $savemenu);
    }

    private function getMenu($root_id)
    {
        $cat=[];
        $query=Categories::where('root_id', '=', $root_id)
        ->where('check', '0');
        $query->orderBy('position', 'DESC');
        $mainmenus = $query->get();
        foreach($mainmenus as $mainmenu)
        {
            $cat[]=[
                'id'=>$mainmenu->id,
                'name_ka'=>$mainmenu->name_ka,
                'name_en'=>$mainmenu->name_en,
                'children'=>$this->getMenu($mainmenu->id)
            ];
        }

        return $cat;
    }
}
