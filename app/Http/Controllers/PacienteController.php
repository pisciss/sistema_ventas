<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        //  $pacientes =  Paciente::whereNotNull('user_id')->paginate(2);
        //
        //return view('pacientes.index')->with('pacientes', $pacientes);
        return view('pacientes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'nombre' => 'required|min:3',
            'apellido' => 'required|min:3',
            'documento' => 'required',
            'imagen' => 'image'
        ]);

        $ruta_imagen = $request['imagen']->store('foto-perfil', 'public');
        // resizes de la imagen
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 400);
        $img->save();

        $data = $request->all();
        $data['imagen'] = $ruta_imagen;
        $data['user_id'] = Auth::user()->id;
        $paciente = Paciente::create($data);

        $paciente->save();


        return redirect()->action('PacienteController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        return view('pacientes.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        return view('pacientes.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {

        $data = $request->validate([
            'nombre' => 'required|min:3',
            'apellido' => 'required|min:3',
            'documento' => 'required',
            'fecha_nacimiento' => 'date',
            'domicilio' => 'min:10',
            'sexo' => 'min:5',
            'estado_civil' => 'min:5',
            'telefono' => 'numeric',
            'email' => 'email'


        ]);

        $paciente->nombre = $data['nombre'];
        $paciente->apellido = $data['apellido'];
        $paciente->documento = $data['documento'];
        $paciente->fecha_nacimiento = $data['fecha_nacimiento'];
        $paciente->domicilio = $data['domicilio'];
        $paciente->sexo = $data['sexo'];
        $paciente->estado_civil = $data['estado_civil'];
        $paciente->telefono = $data['telefono'];
        $paciente->email = $data['email'];

        if (request('imagen')) {
            $ruta_imagen = $request['imagen']->store('foto-perfil', 'public');
            // resizes de la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 400);
            $img->save();

            $paciente->imagen = $ruta_imagen;
        }


        $paciente->save();
        return redirect()->action('PacienteController@index');

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();
        return redirect()->route('pacientes.index');

        //
    }

    public function dataTable()
    {

        return DataTables::of(Paciente::query())
            ->addColumn('btn', 'pacientes.btn')
            ->rawColumns(['btn'])
            ->toJson();
    }
}
