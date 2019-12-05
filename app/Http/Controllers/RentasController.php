<?php

namespace App\Http\Controllers;

use App\Rentas;
use App\Usuarios;
use App\Vehiculos;
use App\Telefonos;
use Session;
use Illuminate\Http\Request;
use Mail;

class RentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('autenticar',['only'=>['show']]);
    }
    public function index()
    {
        //
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
        if(!Session::has("user_session"))
            return 'U';
        $arregloV = array('Correo_id' => Session::get('user_session')[0],'Vehiculo_id' => $request->idv,'fechaIni' => $request->FI,'hrsRenta' => $request->HR);
        $rentado = Rentas::where("Correo_id",Session::get('user_session')[0])->where("Vehiculo_id",$request->idv)->where("fechaIni",$request->FI)->first();
        if(!empty($rentado)){
            if($rentado['estatus'] == 'E')
                $arregloV = array('estatus'=>'C');
            else
                $arregloV = array('estatus'=>'E');
            $rentado->update($arregloV);
            Self::EnviarEmail($arregloV['Correo_id'],$arregloV['hrsRenta'],$arregloV['Vehiculo_id']);
            return $arregloV['estatus'];
        }
        $newRenta = Rentas::create($arregloV);

        /*$usuario = Usuarios::where('Correo','=',$rentado['Correo_id'])->first();
        $vehiculo = Vehiculos::where('id','=',$rentado['Vehiculo_id'])->first();
        $data = array(
        'correo' => $usuario['Correo'],
        'nombre' => $usuario['Nombre'],
        'appat' => $usuario['ApellidoP'],
        'apmat' => $usuario['ApellidoM'],
        'vehiculo' => $vehiculo['Nombre'],
        'hrs' => $rentado['hrsRenta']
        );
        Mail::send('email_prueba',$data,function($message){
            $message->from('pruebasescuelas1297@gmail.com','MISAEL');
            $message->to('negroblogs2@gmail.com')->subject('asunto');
        });*/
        Self::EnviarEmail($arregloV['Correo_id'],$arregloV['hrsRenta'],$arregloV['Vehiculo_id']);
        return 'E';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rentas  $rentas
     * @return \Illuminate\Http\Response
     */
    public function show(Rentas $rentas, Request $request)
    {
        $renta = Rentas::where('Rentas.id',$request->id)->join('Vehiculos', 'Vehiculo_id', '=', 'Vehiculos.id')->select("fechaIni","hrsRenta","precioDescuento")->first();
        return json_encode($renta,JSON_FORCE_OBJECT);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rentas  $rentas
     * @return \Illuminate\Http\Response
     */
    public function edit(Rentas $rentas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rentas  $rentas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rentas $rentas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rentas  $rentas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rentas $rentas)
    {
        //
    }

    public function EnviarEmail($correo_id,$hrs,$vehiculo_id){
        $usuario = Usuarios::where('Correo','=',$correo_id)->first();
        $vehiculo = Vehiculos::where('id','=',$vehiculo_id)->first();
        $telefono = Telefonos::where('Usuario_id','=',$correo_id)->first();
        $data = array(
        'correo' => $correo_id,
        'nombre' => $usuario['Nombre'],
        'appat' => $usuario['ApellidoP'],
        'apmat' => $usuario['ApellidoM'],
        'vehiculo' => $vehiculo['Nombre'],
        'hrs' => $hrs,
        'telefono' => $telefono['Telefono']
        );

        Mail::send('email_prueba',$data,function($message){
            $message->from('correo','EMPRESAURIOS');
            $message->to('correo del sr')->subject('asunto');
        });
    }
}

