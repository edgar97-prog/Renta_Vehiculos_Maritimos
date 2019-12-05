<?php

namespace App\Http\Controllers;

use App\Usuarios;
use App\Direcciones;
use App\Telefonos;
use App\Vehiculos;
use App\Comentarios;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;

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
        $rol = Session::get('user_session')[1];
        if($rol != 2)
            $user = Usuarios::where('Correo','=',$correo)->with('Telefonos')->first()->toArray();
        else
            $user = Usuarios::where('Correo','=',$correo)->with('Direcciones')->with('Telefonos')->first()->toArray();
         
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
        $validator = Validator::make($request->all(),
            ['Correo'=>'required|max:50',
             'Contra'=>'required|min:8|max:30',
             'Nombre'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'ApellidoP'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'ApellidoM'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'Sexo'=>'min:1|max:1|regex:/[MFI]/u'],
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
        if($validator->fails()){
            return redirect('/usuarios/create')->withErrors($validator,'registro');
        }
        Usuarios::create($request->all());
        $clave = array($request->Correo,1);
        $arregloTel = array('Telefono'=>$request->Telefono,'Usuario_id'=>$request->Correo);
        Telefonos::create($arregloTel);
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
        if(!$request->isMethod("PUT"))
            return redirect('/cuenta');
        if(Session::get('user_session')[1] == 2){
        $validator = Validator::make($request->all(), 
            ['Nombre'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'ApellidoP'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'ApellidoM'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'Sexo'=>'min:1|max:1|regex:/[MFI]/u',
             'Telefono'=>['required','min:7','max:10','regex:/(\b[0-9]{7}$|\b[0-9]{10}$)/u'],
             'Calle'=>'required|min:5|max:50|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ#]/u',
             'Colonia'=>'required|min:5|max:50|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'CP'=>['required','min:5','max:5','regex:/(\b[0-9]{5}$)/u']],
            ['Nombre.required'=>'El nombre es un campo requerido',
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
             'Telefono.regex'=>'El campo telefono tiene un formato distinto.',
             'Calle.min'=>'El nombre de la calle tiene pocos carácteres. min. 5',
             'Calle.max'=>'El nombre de la calle tiene demasiados carácteres. max 50.',
             'Colonia.min'=>'El nombre de la colonia tiene pocos carácteres. min. 5',
             'Colonia.max'=>'El nombre de la colonia tiene demasiados carácteres. max 50.',
             'Calle.regex'=>'El nombre de la calle contiene carácteres no válidos.',
             'Colonia.regex'=>'El nombre de la colonia contiene carácteres no válidos.',
             'CP.min'=>'El código postal debe contener 5 digitos.',
             'CP.max'=>'El código postal debe contener 5 digitos.']);
        }else{
            $validator = Validator::make($request->all(), 
            ['Nombre'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'ApellidoP'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'ApellidoM'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'Sexo'=>'min:1|max:1|regex:/[MFI]/u',
             'Telefono'=>['required','min:7','max:10','regex:/(\b[0-9]{7}$|\b[0-9]{10}$)/u']],
            ['Nombre.required'=>'El nombre es un campo requerido',
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
        } 
        if($validator->fails()){
            return redirect('/usuarios')->withErrors($validator,'actualiza');
        }
        $usuario = Usuarios::where('Correo','=',Session::get('user_session')[0])->first();
        $usuario->update($request->all());
        $telefono = Telefonos::where('Usuario_id','=',Session::get('user_session')[0])->first();
        $telefono->update($request->all());
        if(Session::get('user_session')[1] == 2){
            $direccion = Direcciones::where('Correo_id','=',Session::get('user_session')[0])->first();
            $direccion->update($request->all());
        }
        return redirect()->route('usuarios.index')->with('mensaje','Modificación exitosa');
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
        $validator = Validator::make($request->all(),
            ['Correo'=>'required|min:9|max:50','Contra'=>'required|min:6|max:25'],['Correo.required'=>'Es necesario que ingrese su correo','Correo.min'=>'El correo no cumple con lo requerido','Correo.max'=>'El correo excede el límite de caracteres','Contra.max'=>'La contraseña excede el límite de caracteres','Contra.min'=>'La contraseña debe contener más de 6 carácteres']);
        if($validator->fails()){
            return back()->withErrors($validator,'login');
        }

        $correo = $request->Correo;
        $user = Usuarios::where('Correo','=',$correo)->get();
        if(empty($user[0])){
            return back()->withErrors(array('message' => 'Datos incorrectos'),'login');
        }else{
            if($user[0]->Contra == $request->Contra){
                $rol = $user[0]->rol_id;
                $clave = array($correo,$rol);
                $request->session()->put('user_session',$clave);
                return redirect()->back();
            }
            return back()->withErrors(array('message' => 'Datos incorrectos'),'login');
        } 
    }
    public function logout(){
        Session::flush();
        //session()->forget('user_session');
        return redirect('/');
    }

    public function inicio(){
        if(Session::has('user_session')){
           $rol = Session::get('user_session')[1];
        
        }else{
            $rol = 1;
        }
        $vehiculos = Vehiculos::with('Fotos')->get();
        if(count($vehiculos) == 0){
            $Fotos = array();
            $idvehiculos = array();
            $vehiculoMostrado = array();
            return view('welcome',compact('rol','Fotos','vehiculoMostrado','idvehiculos'));
        }
        else{
            if(!is_null($vehiculos)){
            $Fotos = array();
            $idvehiculos = array();
        if(count($vehiculos[0]->fotos)>0){
            for ($i=0; $i < 3; $i++) { 
               $numvehiculo = rand(0,(count($vehiculos)-1));
               $numfoto = rand(0,count($vehiculos[$numvehiculo]->fotos)-1);
              $foto = $vehiculos[$numvehiculo]->fotos[$numfoto]['Foto'];
             array_push($idvehiculos, $vehiculos[$numvehiculo]->id);
             array_push($Fotos,$foto);
        }
            
        }

            $vehiculosOferta = Vehiculos::get('id');
            $vehiculoRandom = rand(0,count($vehiculosOferta)-1);
            $vehiculoMostrado = Vehiculos::where('id','=',$vehiculosOferta[$vehiculoRandom]['id'])->with('Fotos')->with('TipoVehiculo')->get();
                return view('welcome',compact('rol','Fotos','vehiculoMostrado','idvehiculos'));

           /* $vehiculosOferta = Vehiculos::where('Descuento','<>',0)->get('id');
            $vehiculoRandom = rand(0,count($vehiculosOferta)-1);
            $vehiculoMostrado = Vehiculos::where('id','=',$vehiculosOferta[$vehiculoRandom]['id'])->with('Fotos')->with('TipoVehiculo')->get();
                return view('welcome',compact('rol','Fotos','vehiculoMostrado','idvehiculos'));*/
            }
        }
        
        return view('welcome',compact('rol'));
    }
    
    public function storeEmpleado(Request $request)
    {
        $validator = Validator::make($request->all(),
            ['Correo'=>'required|max:50',
             'Contra'=>'required|min:8|max:30',
             'Nombre'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'ApellidoP'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'ApellidoM'=>'required|min:3|max:20|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'Sexo'=>'min:1|max:1|regex:/[MF]/u',
             'Telefono'=>['required','min:7','max:10','regex:/(\b[0-9]{7}$|\b[0-9]{10}$)/u'],
             'Calle'=>'required|min:5|max:50|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ#]/u',
             'Colonia'=>'required|min:5|max:50|regex:/[a-zA-Z ñÑáéíóúÁÉÍÓÚ]/u',
             'CP'=>['required','min:5','max:5','regex:/(\b[0-9]{5}$)/u']],
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
             'Telefono.regex'=>'El campo telefono tiene un formato distinto.',
             'Calle.min'=>'El nombre de la calle tiene pocos carácteres. min. 5',
             'Calle.max'=>'El nombre de la calle tiene demasiados carácteres. max 50.',
             'Colonia.min'=>'El nombre de la colonia tiene pocos carácteres. min. 5',
             'Colonia.max'=>'El nombre de la colonia tiene demasiados carácteres. max 50.',
             'Calle.regex'=>'El nombre de la calle contiene carácteres no válidos.',
             'Colonia.regex'=>'El nombre de la colonia contiene carácteres no válidos.']);
        if($validator->fails()){
            return redirect('/usuarios/create')->withErrors($validator,'registro');
        }
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

    public function comentario(Request $request)
    {
        $comentario = $request->comentario;
        $email = Session::get('user_session')[0];
        $existenciaComent = Comentarios::where('correoUser_id','=',$email)->get()->toArray();
        if(empty($existenciaComent))
        {
             $datos = array('correoUser_id' => $email, 'comentario'=>$comentario );
        if(Comentarios::create($datos))
            return "Comentario Enviado, Gracias.";
        else
            return "Ha Ocurrido un Error, intetelo de nuevo.";
        }
        else
        {
           $nuevoComent = $existenciaComent[0]['comentario']."!<>".$comentario;
           $recursoComentario = Comentarios::where('correoUser_id','=',$email)->first();
           $recursoComentario->comentario = $nuevoComent;
           if($recursoComentario->save())
                return "Comentario Enviado, Gracias.";
            else
                return "Ha Ocurrido un Error, intetelo de nuevo.";
        }
    }
    public function muestraComentarios()
    {
        $datos = Comentarios::with('Usuario')->select("correoUser_id","updated_at")->orderByRaw('updated_at DESC')->get()->toArray();
        return json_encode($datos,JSON_FORCE_OBJECT);
    }
    public function obtenerMensajes(Request $request)
    {
        $datos = Comentarios::where('correoUser_id','=',$request->id)->select("comentario")->first()->toArray();
        $mensajes = explode("!<>",$datos["comentario"]);
        return json_encode($mensajes,JSON_FORCE_OBJECT);   
    }
    public function datosCliente(Request $request)
    {
        $datos = Usuarios::where('Correo','=',$request->id)->with("Telefonos")->first()->toArray();
        return json_encode($datos,JSON_FORCE_OBJECT);
    }
}
