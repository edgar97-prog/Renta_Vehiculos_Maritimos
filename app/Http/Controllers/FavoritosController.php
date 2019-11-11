<?php

namespace App\Http\Controllers;

use App\Favoritos;
use Illuminate\Http\Request;
use Session;

class FavoritosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         //return redirect()->route('vehiculos.index')->with('mensaje','El Vehiculo se Agrego Correctamente');
        return redirect('/catalogo');
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
        //
        if(!Session::has('user_session')){
            return 0;
        }
        else{
            $Vehiculo_id = $request->Vehiculo_id;
            $id = Session::get('user_session')[0];
            $datos = array('Vehiculo_id' => $Vehiculo_id, 'Correo_id' => $id);
            if(Favoritos::create($datos))
                return '1';
            else
                return '2';
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Favoritos  $favoritos
     * @return \Illuminate\Http\Response
     */
    public function show(Favoritos $favoritos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Favoritos  $favoritos
     * @return \Illuminate\Http\Response
     */
    public function edit(Favoritos $favoritos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Favoritos  $favoritos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favoritos $favoritos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Favoritos  $favoritos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favoritos $favoritos)
    {
        //
    }
}
