<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Portfolio;

class PortfolioEditController extends Controller
{
    public function execute ( Portfolio $portfolio, Request $request ) {
        $old = $portfolio->toArray();

        if ( $request->isMethod('delete') ) {
            $portfolio->delete();

            return redirect()->route('portfolio')->with('status', 'Портфолио удалено успешно');
        }

        if ($request->isMethod('post')) {
            $input = $request->except('_token');
            $validator = Validator::make($input, [
                'name'=>'required|max:255',
                'filter'=>'required|max:255'
            ]);

            if($request->hasFile('img')) {
                $file = $request->file('img');
                $input['img'] = $file->getClientOriginalName();
                $file->move(public_path().'/assets/img/', $input['img']);
            } else {
                $input['img'] = $input['old_img'];
            }

            unset($input['old_img']);

            $portfolio->fill($input);

            if ($portfolio->update()) {
                return redirect()->route('portfolio')->with('status', 'Портфолио отредактирована успешно');
            }
        }

        if (view()->exists('site.admin.portfolio.portfolio_edit')) {
            $data = [
                'title'=>'Редактирование страницы - '.$portfolio->name,
                'data' => $old
            ];
            return view('site.admin.portfolio.portfolio_edit', $data);
        }
    }
}
