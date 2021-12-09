<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    function index(){
        $data = [];
        $data['page'] = 'Inicio';
        return view('index')->with($data);
    }
}
