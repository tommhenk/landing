<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Service;

class ServiceAddController extends Controller
{
    public function execute( Request $request ) {

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

            $service = new Service;
            if($service->fill($input)->save()){
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
            $data = ['title'=>'Добавление сервиса', 'icons'=>$lists];
            return view('site.admin.services.services_add')->with($data);
        }
    }
}
