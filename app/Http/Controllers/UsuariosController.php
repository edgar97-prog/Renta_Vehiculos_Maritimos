<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuarios::all();
        return view('usuarios.index',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate(
            ['Correo'=>'required|max:50',
             'Contra'=>'required|min:8|max:30',
             'Nombre'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'ApellidoP'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'ApellidoM'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'Sexo'=>'min:1|max:1|regex:/[HM]/u'],
            ['Correo.required'=>'Debes ingresar un correo',
             'Contra.required'=>'Debes ingresar una contraseña',
             'Contra.min'=>'La contraseña debe tener minimo 8 caracteres',
             'Contra.max'=>'La contraseña es muy larga',
             'Nombre.required'=>'El nombre es un campo requerido',
             'Nombre.min'=>'El nombre debe contener al menos 3 caracteres',
             'Nombre.max'=>'El nombre es demasiado largo',
             'Nombre.regex'=>'El nombre sólo debe contener letras',
             'ApellidoP.required'=>'El apellido paterno es un campo requerido',
             'ApellidoP.min'=>'El apellido paterno debe contener al menos 3 caracteres',
             'ApellidoP.max'=>'El apellido paterno es demasiado largo',
             'ApellidoP.regex'=>'El apellido paterno sólo debe contener letras',
             'ApellidoM.required'=>'El apellido materno es un campo requerido',
             'ApellidoM.min'=>'El apellido materno debe contener al menos 3 caracteres',
             'ApellidoM.max'=>'El apellido materno es demasiado largo',
             'ApellidoM.regex'=>'El apellido materno sólo debe contener letras',
             'Sexo.regex'=>'El atributo sexo se ha modificado, intente nuevamente recargando la página.']);

        Usuarios::create($request->all());

        $usuarios = Usuarios::all();
        return view('usuarios.index',compact('usuarios'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show(Usuarios $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuarios $usuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuarios $usuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuarios $usuarios)
    {
        //
    }
}
