<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;

class PortfoliosController extends Controller
{
    public function execute () {
        $portfolios = Portfolio::all();
        if(view()->exists('site.admin.portfolio.portfolio')) {
            $data = [
                'title'=>'Портфолио',
                'portfolios'=>$portfolios
            ];
            return view('site.admin.portfolio.portfolio', $data);
        }
    }
}
