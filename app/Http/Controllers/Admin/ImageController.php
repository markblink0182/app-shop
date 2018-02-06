<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use File;
use App\Http\Controllers\Controller;
class ImageController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id); //obtenemos el producto en base al ID
        $images = $product->images()->orderBy('featured','desc')->get(); //obtenemos las images del producto
        return view('admin.products.images.index')->with(compact('product','images')); //enviamos esa info a la vista
    }

    public function store(Request $request, $id)
    {
        //Guardar imagen en nuestro proyecto
        $file = $request->file('photo');
        $path = public_path().'/images/products'; //Ruta donde vamos a guardar la imagen
        $filename = uniqid().$file->getClientOriginalName(); //Definimos un nombre para el archivo (Id unico + el nombre del archivo)
       $moved =  $file->move($path, $filename); //guardar la imagen

        if($moved)
        {
            //Crear 1 registro en la BD, product_images
            $productImage = new ProductImage();
            $productImage->image = $filename;
            $productImage->product_id = $id;
            $productImage->save();
        }

        return back(); //redirigir al usuario donde se encontraba antes
    }

    public function destroy(Request $request)
    {
        //eliminar el archivo del directorio
        $productImage = ProductImage::find($request->image_id);
        if(substr($productImage->image,0,4)==="http")
        {
            $deleted = true;
        }
        else
        {
            $fullPath = public_path().'/images/products/'.$productImage->image;
            $deleted = File::delete($fullPath);
        }

            if($deleted)
            {
                $productImage->delete();
            }
            return back();

        //eliminar el archivo de la BD
    }

    public function select($id, $image)
    {
        //desmarcar antes de hacer un featured
        ProductImage::where('product_id', $id)->update([
            'featured' => false
        ]);
        //marcar imagen destacada
        $productImage = ProductImage::find($image);
        $productImage->featured = true;
        $productImage->save();

        return back();
    }
}
