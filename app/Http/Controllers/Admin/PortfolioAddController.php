<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Portfolio;

class PortfolioAddController extends Controller
{
    public function execute ( Request $request ) {

        if ($request->isMethod('post')) {
            $input = $request->except('_token');
            // dd($input);
            $validator = Validator::make($input, [
                'name'=>'required|max:255',
                'filter'=>'required|max:255|unique:portfolios,filter',
            ]);

            if ( $validator->fails() ) {
                return redirect()->route('portfolioAdd')->withErrors($validator);
            }

            if($request->hasFile('img')) {
                $file = $request->file('img');
                $input['img'] = $file->getClientOriginalName();
                $file->move(public_path().'/assets/img/',$input['img']);
            }

            $portfolio = new Portfolio;
            $portfolio->fill($input);
            if($portfolio->save()) {
                return redirect()->route('portfolio')->with('status', 'Портфолио добавлено успешно');
            }
        }

        if( view()->exists('site.admin.portfolio.portfolio_add') ) {

            $data = ['title' => 'Добавление портфолио'];

            return view('site.admin.portfolio.portfolio_add', $data);
        }
    }
}
