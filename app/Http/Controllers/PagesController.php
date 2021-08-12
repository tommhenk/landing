<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PagesController extends Controller
{
    public function execute() {
        // dd(111);
        if(view()->exists('site.admin.pages')) {

            $pages = Page::all();
            $data = [
                'title'=>'Страницы',
                'pages'=>$pages,
            ];
            return view('site.admin.pages', $data);
        }
        abort(404);
    }
}
