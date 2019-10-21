<?php

namespace App\Http\Controllers;

use App\Vehiculos;
use App\Fotos;
use Illuminate\Http\Request;

class VehiculosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vehiculos = Vehiculos::with('Fotos')->get(); 
        return view('vehiculos.index',compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate(['Nombre'=>'required|min:3|max:25','Cantidad'=>'required'],['Nombre.required'=>'El nombre es requerido','Nombre.min'=>'El nombre debe contener al menos 3 caracteres','Nombre.max'=>'El nombre es demasiado largo']);
        $vehiculo = Vehiculos::create($request->all());
        $imagen = $request->file('Foto');
        $nameImage = $imagen->getClientOriginalName();
        $arrFotos = array('Foto'=>$nameImage,'vehiculos_id'=>$vehiculo->id);
        Fotos::create($arrFotos);
        $imagen->move('fotos',$nameImage);
        
       $contador = $request->contador;
        for($i=1; $i<=$contador; $i++)
        {
            $imagen = $request->file('foto'.$i);
            $nameImage = $imagen->getClientOriginalName();
            $arrFotos['Foto'] = $nameImage;
            Fotos::create($arrFotos);
            $imagen->move('fotos',$nameImage);
        }
        return redirect()->route('vehiculos.index')->with('mensaje','El Vehiculo se Agrego Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehiculos  $vehiculos
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculos $vehiculos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehiculos  $vehiculos
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehiculos $vehiculos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehiculos  $vehiculos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehiculos $vehiculos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehiculos  $vehiculos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculos $vehiculos)
    {
        //
    }

    public function datos(Request $request)
    {
     if($request->isMethod('post'))
        {
        $vehiculos = Vehiculos::find($request->id);

            $i=0;
            $datos = array('id'=>$vehiculos->id,'nombre'=>$vehiculos->Nombre,
            'descripcion'=>$vehiculos->Descripcion,'renta'=>$vehiculos->precioRenta,'cantidad'=>$vehiculos->Cantidad);
            $fotos = array();
        foreach ($vehiculos->fotos as $foto) {
            
            $fotos[$i] = $foto->Foto;
            $i++;
        }

        $data = array($datos,$fotos);

        return json_encode($data,JSON_FORCE_OBJECT);
        }
    }
}
