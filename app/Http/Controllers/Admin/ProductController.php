<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Controllers\Controller;
class ProductController extends Controller
{
    public function index()
    {
        //Inyectar a la vista index la variable $products
        $products = Product::paginate(10);
        return view('admin.products.index')->with(compact('products'));
        return view('welcome')->with(compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $messages = [
          'name.required' => 'Nombre campo obligatorio',
          'name.min'  => 'Nombre Longitud mínima 3 caracteres',
          'descripcion.required' => 'Descripcion es obligatoria',
          'descripcion.max' => 'Descripción máxima 200 caracteres',
          'price.required' => 'Precio campo obligatorio',
          'price.numeric' => 'Ingrese valor válido',
          'price.min' => 'No valores negativos'
        ];
        $rules = [
            'name' => 'required|min:3',

            'price' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules, $messages);
        //dd($request->all());
        $product = new Product();
        $product->name = $request->input('name');
        $product->descripcion = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->save();
        return redirect('/admin/products');
    }

    public function edit($id)
    {

        $product = Product::find($id);
        return view('admin.products.edit')->with(compact('product'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'name.required' => 'Nombre campo obligatorio',
            'name.min'  => 'Nombre Longitud mínima 3 caracteres',
            'description.required' => 'Descripcion es obligatoria',
            'description.max' => 'Descripción máxima 200 caracteres',
            'price.required' => 'Precio campo obligatorio',
            'price.numeric' => 'Ingrese valor válido',
            'price.min' => 'No valores negativos'
        ];
        $rules = [
            'name' => 'required|min:3',
            'description' => 'required|max:200',
            'price' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules, $messages);

        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->descripcion = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->save();
        return redirect('/admin/products');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return back();
    }


}
