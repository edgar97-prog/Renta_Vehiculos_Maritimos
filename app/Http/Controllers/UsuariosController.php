<?php

namespace App\Http\Controllers;

use App\Usuarios;
use App\Direcciones;
use App\Telefonos;
use App\Vehiculos;
use Illuminate\Http\Request;
use Session;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('autenticar',['only'=>['paneladmin','index']]);
        $this->middleware('Is_admin',['only'=>['storeEmpleado']]);
    }
    public function index()
    {
        $correo = Session::get('user_session')[0];
        $user = Usuarios::where('Correo','=',$correo)->first();
        $rol = Session::get('user_session')[1];
        $user2 = Usuarios::where('Correo','=',$correo)->with('Direcciones')->first()->toArray();
        dd($user2);

        
        //Direcciones::where('Correo_id','=',$correo)->with('Usuarios')->first();
        dd($user2);
        return view('usuarios.cuenta',compact('user','rol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Session::has('user_session'))
            return view('usuarios.create');
        $rol = Session::get('user_session')[1];
        if($rol == 3){
            if(Session::has('mensaje')){
                $msj = Session::get('mensaje');
                return view('usuarios.create',compact('rol','msj'));
            }
            else{
                return view('usuarios.create',compact('rol'));
            }
        }
        else
            return redirect('/');
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
             'Sexo'=>'min:1|max:1|regex:/[MF]/u'],
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
        $clave = array($request->Correo,1);
        $request->session()->put('user_session',$clave);
        return redirect('/');
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
    public function destroy(Usuarios $usuarios,$id)
    {
        $usuarios->destroy($id);
        return "exito";
    }

    public function login(Request $request){
        
        $data = request()->validate(['Correo'=>'required|min:9|max:50','Contra'=>'required|max:25'],['Correo.required'=>'Es necesario que ingrese su correo','Correo.min'=>'El correo no cumple con lo requerido','Correo.max'=>'El correo excede el límite de caracteres','Contra.max'=>'La contraseña excede el límite de caracteres']);

        $correo = $request->Correo;
        $user = Usuarios::where('Correo','=',$correo)->get();
        if(empty($user[0])){
            return view('welcome')->withErrors(array('message' => 'Datos incorrectos'));
        }else{
            if($user[0]->Contra == $request->Contra){
                $rol = $user[0]->rol_id;
                $clave = array($correo,$rol);
                $request->session()->put('user_session',$clave);
                return redirect('/');
            }
            return view('welcome')->withErrors(array('message' => 'Datos incorrectos'));
        } 
    }
    public function logout(){
        session()->forget('user_session');
        return redirect('/');
    }
    public function inicio(){
        if(Session::has('user_session')){
            $rol = Session::get('user_session')[1];
        }else{
            $rol = 1;
        }
        $vehiculos = Vehiculos::with('Fotos')->get();
        $Fotos = array();
        for ($i=0; $i < 3; $i++) { 
           $numFoto = rand(0,(count($vehiculos)-1));
           $foto = $vehiculos[$numFoto]->fotos[0]['Foto'];
           array_push($Fotos,$foto);
        }
        
        return view('welcome',compact('rol','Fotos'));
    }
    public function storeEmpleado(Request $request)
    {
        $data = request()->validate(
            ['Correo'=>'required|max:50',
             'Contra'=>'required|min:8|max:30',
             'Nombre'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'ApellidoP'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'ApellidoM'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'Sexo'=>'min:1|max:1|regex:/[MF]/u',
             'Telefono'=>'min:7|max:10|regex:/[0-9]/u'],
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
             'Sexo.regex'=>'El atributo sexo se ha modificado, intente nuevamente recargando la página.',
             'Telefono.min'=>'El telefono está incompleto.',
             'Telefono.max'=>'El telefono contiene números de más.',
             'Telefono.regex'=>'El campo telefono tiene un formato distinto.']);
        $user = new Usuarios;
        $user->Correo = $request->Correo;
        $user->Contra = $request->Contra;
        $user->Nombre = $request->Nombre;
        $user->ApellidoP = $request->ApellidoP;
        $user->ApellidoM = $request->ApellidoM;
        $user->Sexo = $request->Sexo;
        $user->rol_id = 2;
        $user->save();
        $arregloDir = array('Correo_id' => $request->Correo ,'Calle'=>$request->Calle,'Colonia'=>$request->Colonia,'CP'=>$request->CP);
        $dirreccion = Direcciones::create($arregloDir);
        $arregloTel = array('Telefono' => $request->Telefono,'Usuario_id'=>$request->Correo);
        $tel = Telefonos::create($arregloTel);
        return redirect('/usuarios/create')->with('mensaje','Se ha registrado el empleado correctamente');
    }

    public function paneladmin(Request $request)
    {
        $rol = Session::get('user_session')[1];
        if($rol == 3 || $rol == 2)
            return view('paneladmin',compact('rol'));
        else
            return redirect('/');
    }
    public function datosEmpleado(){
        $Empleados = Usuarios::where('rol_id','=','2')->get();
        return json_encode($Empleados,JSON_FORCE_OBJECT);
    }
    public function infoEmpleados(Request $request){
        $dir = Direcciones::where('Correo_id','=',$request->id)->get();
        $tel =  Telefonos::where('Usuario_id','=',$request->id)->get();
        $arreglo = array($dir[0],$tel[0]);
        return json_encode($arreglo,JSON_FORCE_OBJECT);   
    }
}
