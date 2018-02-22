<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use File;
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
        $category =  Category::create($request->only('name','description'));
        if($request->hasFile('image'))//Si el request contiene campo image
        {
            $file = $request->file('image');//Se obtiene la referencia y se guarda en $file
        $path = public_path().'/images/categories'; //Ruta donde vamos a guardar la imagen
        $filename = uniqid().'-'.$file->getClientOriginalName(); //Definimos un nombre para el archivo (Id unico + guion + el nombre de la imagen)
       $moved =  $file->move($path, $filename); //guardar la imagen

        if($moved) //moved = a true
        {
            //update catetegoria
          //  $productImage = new ProductImage(); No se ocupa xq ya se tiene una categoria creada
            $category->image = $filename; //guardamos el nombre del archivo dentro del campo image
            $category->save();//update
        }
        }
       // Category::create($request->all()); //mass assignment
        return redirect('/admin/categories');
    }

    public function edit( Category $category)
    {

       return view('admin.categories.edit')->with(compact('category'));
    }

    public function update(Request $request,Category $category)
    {
        
        $this->validate($request, Category::$rules, Category::$messages);
        $category->update($request->only('name','description'));
        if($request->hasFile('image'))//Si el request contiene campo image
        {
            $file = $request->file('image');//Se obtiene la referencia y se guarda en $file
        $path = public_path().'/images/categories'; //Ruta donde vamos a guardar la imagen
        $filename = uniqid().'-'.$file->getClientOriginalName(); //Definimos un nombre para el archivo (Id unico + guion + el nombre de la imagen)
       $moved =  $file->move($path, $filename); //guardar la imagen

        if($moved) //moved = a true
        {
            $previousPath = $path. '/' .$category->image;
            //update catetegoria
          //  $productImage = new ProductImage(); No se ocupa xq ya se tiene una categoria creada
            $category->image = $filename; //guardamos el nombre del archivo dentro del campo image
            $saved = $category->save();//update
            if($saved)
            {
                File::delete($previousPath);
            }

        }
        }
        return redirect('/admin/categories');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return back();
    }

}
