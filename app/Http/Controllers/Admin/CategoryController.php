<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        //Inyectar a la vista index la variable $products
        $categories = Category::orderBy('name')->paginate(10);
        return view('admin.categories.index')->with(compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
       
        $this->validate($request, Category::$rules, Category::$messages);
        //dd($request->all());
        //
        Category::create($request->all()); //mass assignment
        return redirect('/admin/categories');
    }

    public function edit( Category $category)
    {

       return view('admin.categories.edit')->with(compact('category'));
    }

    public function update(Request $request,Category $category)
    {
        
        $this->validate($request, Category::$rules, Category::$messages);
        $category->update($request->all());
        return redirect('/admin/categories');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return back();
    }

}
