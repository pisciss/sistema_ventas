<?php

namespace App\Http\Controllers;

use App\Venta;
use App\DetalleVenta;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Carbon;
use Response;
use Illuminate\Support\Collection;

class VentaController extends Controller
{
    public function index(Request $request)
    {

        $query = trim($request->get('busca'));
        $ventas =  Venta::join('clientes as c', 'c.id', '=', 'ventas.id_cliente')
            ->join('detalle_venta as d', 'd.id_venta', '=', 'ventas.id')
            ->select('ventas.id', 'ventas.fecha_hora', 'c.nombre', 'ventas.tipo_comprobante', 'ventas.serie_comprobante', 'ventas.num_comprobante', 'ventas.impuesto', 'ventas.estado', 'ventas.total_venta')
            ->where('ventas.num_comprobante', 'LIKE', '%' . $query . '%')
            ->orderby('ventas.id', 'desc')
            ->groupBy('ventas.id', 'ventas.fecha_hora', 'c.nombre', 'ventas.tipo_comprobante', 'ventas.serie_comprobante', 'ventas.num_comprobante', 'ventas.impuesto', 'ventas.estado', 'ventas.total_venta')
            ->paginate(7);
        //
        return view('ventas.index', ["ventas" => $ventas, "busca" => $query]);
    }
    public function create()
    {
        $clientes = DB::table('clientes')->get();
        $productos = DB::table('productos as pro')
            ->join('detalle_ingreso as di', 'pro.id', '=', 'di.id_producto')
            ->select(DB::raw('CONCAT(pro.codigo," ",pro.nombre) AS producto'), 'pro.id', 'pro.stock', DB::raw("(SELECT d.precio_venta FROM detalle_ingreso as d where d.id_producto=pro.id order by d.id desc limit 1) as precio_final"))
            ->where('pro.estado', '=', 'Activo')
            ->where('pro.stock', '>', '0')
            ->groupBy('pro.id', 'pro.codigo', 'pro.nombre', 'pro.stock')
            ->get();
        return view('ventas.create', ["clientes" => $clientes, "productos" => $productos]);
    }

    public function store(Request $request)


    {
        $request->validate([

            'id_cliente' => 'required',
            'tipo_comprobante' => 'required|max:20',
            'serie_comprobante' => 'max:7',
            'id_producto' => 'required',
            'cantidad' => 'required',
            'descuento' => 'required'



        ]);


        try {
            DB::beginTransaction();
            $venta = new Venta;
            $venta->id_cliente = $request->get('id_cliente');
            $venta->tipo_comprobante = $request->get('tipo_comprobante');
            $venta->serie_comprobante = $request->get('serie_comprobante');
            $venta->num_comprobante = $request->get('num_comprobante');

            $mytime = Carbon::now('America/Argentina/Buenos_Aires');
            $venta->fecha_hora = $mytime->toDateTimeString();
            $venta->impuesto = '21';
            $venta->total_venta = $request->get('total_venta');
            $venta->estado = 'A';
            $venta->save();

            $id_producto = $request->get('id_producto');
            $cantidad = $request->get('cantidad');
            $descuento = $request->get('descuento');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;
            while ($cont < count($id_producto)) {

                $detalle = new DetalleVenta();
                $detalle->id_venta = $venta->id;
                $detalle->id_producto = $id_producto[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->descuento = $descuento[$cont];
                $detalle->precio_venta = $precio_venta[$cont];
                $detalle->save();
                $cont = $cont + 1;
            }



            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withError($e->getMessage())->withInput();
        }
        return redirect()->action('VentaController@index');
    }

    public function show($id)
    {

        $venta =   Venta::join('clientes as c', 'c.id', '=', 'ventas.id_cliente')
            ->join('detalle_venta as d', 'd.id_venta', '=', 'ventas.id')
            ->select('ventas.id', 'ventas.fecha_hora', 'c.nombre', 'ventas.tipo_comprobante', 'ventas.serie_comprobante', 'ventas.num_comprobante', 'ventas.impuesto', 'ventas.estado', 'ventas.total_venta')
            ->where('ventas.id', '=', $id)
            ->first();

        $detalles = DB::table('detalle_venta as d')
            ->join('productos as p', 'd.id_producto', '=', 'p.id')
            ->select('p.nombre as producto', 'd.cantidad', 'd.descuento', 'd.precio_venta')
            ->where('d.id_venta', '=', $id)->get();

        return view('ventas.show', ["venta" => $venta, "detalles" => $detalles]);
    }




    public function destroy($id)

    {
        $venta = Venta::findOrFail($id);
        $venta->estado = 'C';
        $venta->update();
        return redirect()->route('ventas.index');
    }
}
