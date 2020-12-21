<?php

namespace App\Http\Controllers;


use App\Producto;
use App\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProductoForm;
use Illuminate\Support\Facades\Auth;


class ProductoController extends Controller
{
    public function index(Request $request)
    {

        $query = trim($request->get('busca'));
        $productos =  Producto::join('categorias as c', 'c.id', '=', 'productos.id_categoria')
            ->select('productos.id', 'productos.nombre', 'productos.descripcion', 'productos.codigo', 'c.nombre as categoria', 'productos.imagen', 'productos.estado', 'productos.precio_compra', 'productos.precio_venta', 'productos.stock')
            ->where('productos.nombre', 'LIKE', '%' . $query . '%')
            ->orwhere('productos.codigo', 'LIKE', '%' . $query . '%')->paginate(7);
        //
        return view('productos.index', ["productos" => $productos, "busca" => $query]);
    }
    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', ["categorias" => $categorias]);
    }

    public function store(Request $request)


    {
        $request->validate([
            'codigo' => 'required|max:40',
            'nombre' => 'required|max:50',
            'id_categoria' => 'required',
            'descripcion' => 'max:256',
            'precio_compra' => 'numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/|nullable',
            'precio_venta' => 'numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/|nullable',
            'stock' => 'numeric|required',

        ]);
        $data = $request->all();
        if (request('imagen')) {
            $ruta_imagen = $request['imagen']->store('foto-perfil', 'public');
            // resizes de la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 400);
            $img->save();
            $data['imagen'] = $ruta_imagen;
        }




        $data['estado'] = 'activo';

        $producto = Producto::create($data);

        $producto->save();

        return redirect()->action('ProductoController@index');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();

        return view('productos.edit', ["producto" => $producto, "categorias" => $categorias]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'codigo' => 'required|max:40',
            'nombre' => 'required|max:50',
            'id_categoria' => 'required',
            'descripcion' => 'max:256',
            'imagen' => 'image',
            'precio_compra' => 'numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/|nullable',
            'precio_venta' => 'numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/|nullable',
            'stock' => 'numeric|required'
        ]);


        $producto = Producto::findOrFail($id);
        $producto->nombre = $request->get('nombre');
        $producto->descripcion = $request->get('descripcion');
        $producto->id_categoria = $request->get('id_categoria');
        $producto->codigo = $request->get('codigo');

        if (request('imagen')) {
            $ruta_imagen = $request['imagen']->store('imagen', 'public');
            // resizes de la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 400);
            $img->save();

            $producto->imagen = $ruta_imagen;
        }
        $producto->save();

        return redirect()->action('ProductoController@index');
    }

    public function destroy($id)

    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index');
    }
}
