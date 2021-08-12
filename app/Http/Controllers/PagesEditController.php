<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use Validator;

class PagesEditController extends Controller
{
    public function execute ( Page $page, Request $request) {
        // $page = Page::findOrFail($page);

        if ($request->isMethod('delete')) {
            $page->delete();
            return redirect()->route('pages')->with('status', 'Страница удалена');
        }

        $old = $page->toArray();
        // dd($old);
        if ($request->isMethod('post')) {
            $input = $request->except('_token');

            $validator = Validator::make($input, [
                'name'=>'required|max:255',
                'alias'=>'required|max:255|unique:pages,alias,'.$input['id'],
                'text'=>'required',
            ]);
            if ($validator->fails()) {
                return redirect()->route('pagesEdit', ['page'=>$input['id']])->withErrors($validator);
            }

            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $file->move(public_path().'/assets/img/',$file->getClientOriginalName());
                $input['img'] = $file->getClientOriginalName();
            }else {
                $input['img'] = $input['old_img'];
            }
            unset($input['old_img']);

            $page->fill($input);
            if($page->update()) {
                return redirect()->route('pages')->with('status', 'Страница обновлена');
            }
        }
        if(view()->exists('site.admin.pages_edit')) {
            $data = [
                'title'=>"Редактирование страницы - ". $old['name'],
                'data'=> $old
            ];
            return view('site.admin.pages_edit', $data);
        }
    }
}
