<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function welcome()
    {
        $categories = Category::has('products')->get();
//        Inyectar los datos a la vista |
        return view('welcome')->with(compact('categories'));
    }
}
