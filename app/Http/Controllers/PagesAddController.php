<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Page;
class PagesAddController extends Controller
{
    public function execute( Request $request ) {

        if ($request->isMethod('post')) {
            $input = $request->except('_token');
            $messages = [
                'required' => 'Поле :attribute обязательно к заполнению',
                'unique' => 'Поле :attribute должно быть уникальным'
            ];
            $validator = Validator::make($input, [
                'name'=>'required|max:255',
                'alias'=>'required|unique:pages|max:255',
                'text'=>'required',
            ], $messages);

            if ($validator->fails()) {
                return redirect()->route('pagesAdd')->withErrors($validator)->withInput();
            }
            if($request->hasFile('img')) {
                $file = $request->file('img');
                $input['img'] = $file->getClientOriginalName();
                
                $file->move(public_path().'/assets/img/', $input['img']);
            }
            $page = new Page;
            $page->fill($input);

            if($page->save()){
                return redirect()->route('admin')->with('status', 'Страница добавлена');
            }
        }

        if(view()->exists('site.admin.pages_add')) {
            $data = ['title'=>'Новая страница'];
            return view('site.admin.pages_add', $data);
        }
        abort(404);
    }
}
