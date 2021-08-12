<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Service;

class ServiceEditController extends Controller
{
        public function execute( Request $request, Service $service ) {

        if ($request->isMethod('delete')) {
            $service->delete();
            return back()->with('status', 'Страница удвлена');
        }

        if ($request->isMethod('post')) {
            
            $input = $request->except('_token');

            $validator = Validator::make($input, [
                'name'=>'required|max:255',
                'text'=>'required',
                'icon'=>'required'
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator);
            }

            if($service->fill($input)->update()){
                return redirect()->route('service')->with('status', 'Сервис добавлено успешно');
            }
        }

        if (view()->exists('site.admin.services.service_content_add')) {
            $icons = Service::select('id', 'icon')->get();
            $lists = [];
            foreach ($icons as $icon) {
                $lists[$icon->icon] = $icon->icon;
            }
            // dd($lists);
            $data = ['title'=>'Редактирование сервиса', 'icons'=>$lists, 'service'=>$service];
            return view('site.admin.services.services_add')->with($data);
        }
    }
}
