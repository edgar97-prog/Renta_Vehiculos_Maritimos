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
        $usuario = new Usuarios;
        $usuario->Correo = $request->Correo;
        $usuario->Contra = $request->Contra;
        $usuario->Nombre = $request->Nombre;
        $usuario->ApellidoP = $request->Ap;
        $usuario->ApellidoM = $request->Am;
        $usuario->Sexo = $request->Sexo;
        $usuario->rol_id = 1;
        $usuario->save();
        
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

    public function login(Request $request){
        
        $data = request()->validate(['Correo'=>'required|min:9|max:50','Contra'=>'required|max:25'],['Correo.required'=>'Es necesario que ingrese su correo','Correo.min'=>'El correo no cumple con lo requerido','Correo.max'=>'El correo excede el límite de caracteres','Contra.max'=>'La contraseña excede el límite de caracteres']);

        $correo = $request->Correo;
        $user = Usuarios::where('Correo','=',$correo)->get();;
        if(empty($user[0])){
            return redirect('/login');
        }else{
            if($user[0]->Contra == $request->Contra){
                //$usuarios = Usuarios::all();
                $request->session()->put('user_session',$correo);
                /*$aux = $request->session()->get('user_sessio',function(){
                    echo "NO HAY SESION DE USUARIO";
                });
                echo $aux;
                if (session::has('user_session')) {
                    #dd(session::has('user_session'));
                    #echo $request->session()->get('user_session');
                }*/
                return view('welcome');
            }

        }
        
    }
    public function logout(){
        session()->forget('user_session');
        return redirect('/');
    }
}
