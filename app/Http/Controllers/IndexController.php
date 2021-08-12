<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use App\Models\Page;
use App\Models\Service;
use App\Models\Portfolio;
use DB;

use Illuminate\Support\Facades\Mail;
use App\Mail\MyMail;

class IndexController extends Controller
{
    public function execute( Request $request ) {
        
        if ($request->isMethod('post')) {

            $messages = [
                'required'=> 'Поле :attribute обязательно к заполнению',
                'email' => 'Поле :attribute должно соответствовать корректному email адресу',
            ];

            $this->validate($request, [
                'name'=>'required|max:255',
                'email'=>'required|email',
                'text'=>'required'
            ],$messages);

            $data = $request->all();

            Mail::to(env('MAIL_USERNAME'))->send(new MyMail($data));
            return redirect()->route('home')->with('status', 'email is send');
        }

        $pages = Page::all();
        $portfolios = Portfolio::all();
        $services = Service::where('id', '>', 0)->get();
        $peoples = People::take(3)->get();

        $menu = [];
        foreach ($pages as $page) {
            $item = ['title'=> $page->name,'alias'=>$page->alias];
            array_push($menu, $item);
        }
        $item = ['title'=>'Services' ,'alias'=>'service'];
        array_push($menu, $item);


        $item = ['title'=>'Portfolio' ,'alias'=>'Portfolio'];
        array_push($menu, $item);


        $item = ['title'=>'Team' ,'alias'=>'team'];
        array_push($menu, $item);

        $item = ['title'=>'Contact' ,'alias'=>'contact'];
        array_push($menu, $item);

        $tags = DB::table('portfolios')->distinct()->pluck('filter');
        // dd($tags);
        // dd($menu); 
        return view('site.index', [
            'menu'=>$menu,
            'pages'=>$pages,
            'services'=>$services,
            'portfolios'=>$portfolios,
            'peoples'=>$peoples,
            'tags'=>$tags,
        ]);
    }
}
