<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function execute(){
        $services = Service::all();
        if (view()->exists('site.admin.services.services')) {
            $data = [
                'title'=>'Сервисы',
                'services'=>$services,
            ];
            return view('site.admin.services.services')->with($data);
        }
    }
}
