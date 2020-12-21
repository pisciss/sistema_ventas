<?php

namespace App\Http\Controllers;

use App\Ingreso;
use App\DetalleIngreso;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Carbon;
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller
{
    public function index(Request $request)
    {

        $query = trim($request->get('busca'));
        $ingresos =   Ingreso::join('proveedores as p', 'p.id', '=', 'ingresos.id_proveedor')
            ->join('detalle_ingreso as d', 'd.id_ingreso', '=', 'ingresos.id')
            ->select('ingresos.id', 'ingresos.fecha_hora', 'p.nombre', 'ingresos.tipo_comprobante', 'ingresos.serie_comprobante', 'ingresos.num_comprobante', 'ingresos.impuesto', 'ingresos.estado', DB::raw('sum(d.cantidad*precio_compra) as total'))
            ->where('ingresos.num_comprobante', 'LIKE', '%' . $query . '%')
            ->orderby('ingresos.id', 'desc')
            ->groupBy('ingresos.id', 'ingresos.fecha_hora', 'p.nombre', 'ingresos.tipo_comprobante', 'ingresos.serie_comprobante', 'ingresos.num_comprobante', 'ingresos.impuesto', 'ingresos.estado')
            ->paginate(7);
        //
        return view('ingresos.index', ["ingresos" => $ingresos, "busca" => $query]);
    }
    public function create()
    {
        $proveedores = DB::table('proveedores')->get();
        $productos = DB::table('productos as pro')
            ->select(DB::raw('CONCAT(pro.codigo," ",pro.nombre) AS producto'), 'pro.id')
            ->where('pro.estado', '=', 'Activo')
            ->get();
        return view('ingresos.create', ["proveedores" => $proveedores, "productos" => $productos]);
    }

    public function store(Request $request)


    {
        $request->validate([

            'id_proveedor' => 'required',
            'tipo_comprobante' => 'required|max:20',
            'serie_comprobante' => 'max:7',
            'id_producto' => 'required',
            'cantidad' => 'required',
            'precio_compra' => 'required',
            'precio_venta' => 'required'

        ]);


        try {
            DB::beginTransaction();
            $ingreso = new Ingreso;
            $ingreso->id_proveedor = $request->get('id_proveedor');
            $ingreso->tipo_comprobante = $request->get('tipo_comprobante');
            $ingreso->serie_comprobante = $request->get('serie_comprobante');
            $ingreso->num_comprobante = $request->get('num_comprobante');
            $mytime = Carbon::now('America/Argentina/Buenos_Aires');
            $ingreso->fecha_hora = $mytime->toDateTimeString();
            $ingreso->impuesto = '18';
            $ingreso->estado = 'A';
            $ingreso->save();

            $id_producto = $request->get('id_producto');
            $cantidad = $request->get('cantidad');
            $precio_compra = $request->get('precio_compra');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;
            while ($cont < count($id_producto)) {

                $detalle = new DetalleIngreso();
                $detalle->id_ingreso = $ingreso->id;
                $detalle->id_producto = $id_producto[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->precio_compra = $precio_compra[$cont];
                $detalle->precio_venta = $precio_venta[$cont];
                $detalle->save();
                $cont = $cont + 1;
            }



            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withError($e->getMessage())->withInput();
        }
        return redirect()->action('IngresoController@index');
    }

    public function show($id)
    {

        $ingreso =   Ingreso::join('proveedores as p', 'p.id', '=', 'ingresos.id_proveedor')
            ->join('detalle_ingreso as d', 'd.id_ingreso', '=', 'ingresos.id')
            ->select('ingresos.id', 'ingresos.fecha_hora', 'p.nombre', 'ingresos.tipo_comprobante', 'ingresos.serie_comprobante', 'ingresos.num_comprobante', 'ingresos.impuesto', 'ingresos.estado', DB::raw('sum(d.cantidad*precio_compra) as total'))
            ->where('ingresos.id', '=', $id)
            ->groupBY('ingresos.id', 'ingresos.fecha_hora', 'p.nombre', 'ingresos.tipo_comprobante', 'ingresos.serie_comprobante', 'ingresos.num_comprobante', 'ingresos.impuesto', 'ingresos.estado')
            ->first();

        $detalles = DB::table('detalle_ingreso as d')
            ->join('productos as p', 'd.id_producto', '=', 'p.id')
            ->select('p.nombre as producto', 'd.cantidad', 'd.precio_compra', 'd.precio_venta')
            ->where('d.id_ingreso', '=', $id)->get();

        return view('ingresos.show', ["ingreso" => $ingreso, "detalles" => $detalles]);
    }




    public function destroy($id)

    {
        $ingreso = Ingreso::findOrFail($id);
        $ingreso->estado = 'C';
        $ingreso->update();
        return redirect()->route('ingresos.index');
    }
}
