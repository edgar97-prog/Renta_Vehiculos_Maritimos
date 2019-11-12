<?php

namespace App\Http\Controllers;

use App\Vehiculos;
use App\Fotos;
use App\Usuarios;
use App\TipoVehiculos;
use Session;
use Illuminate\Http\Request;

class VehiculosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('autenticar',['only'=>['store','index','update','destroy','datos,','busqueda']]);
        $this->middleware('Both_user',['only'=>['store','index','update','destroy','datos,','busqueda']]);
    }
    public function index()
    {
        //
        $vehiculos = Vehiculos::with('Fotos')->with('TipoVehiculo')->get();
  
        $tipoVehiculos = TipoVehiculos::all();
        $rol = Session::get('user_session')[1];
        return view('vehiculos.index',compact('vehiculos','rol','tipoVehiculos'));
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
        $data = request()->validate(['Nombre'=>'required','horasRenta'=>'required',
          'Foto'=>'required','Descripcion'=>'required','precioRenta'=>'required',
          'horasRenta'=>'required','tipoVehiculos_id'=>'required'],['Nombre.required'=>'El nombre es requerido',
          'Foto.required'=>'Debe elegir por lo menos una imagen para mostrar a los clientes',
          'Descripcion.required'=>'Necesita agregar una descripción',
          'horasRenta.required'=>'Debe agregar la(s) hora(s) minima(s) de renta',
          'precioRenta.required'=>'Debe agregar un precio de renta',
          'tipoVehiculos_id.required'=>'Debe seleccionar un tipo de vehiculo']);

        $precioDescuento =$request->precioRenta - (($request->precioRenta * ($request->Descuento * 0.01)));

        $datos = array('Nombre'=>$request->Nombre,'Descripcion'=>$request->Descripcion,
                    'precioRenta'=>$request->precioRenta,'precioDescuento'=>$precioDescuento,
                    'Descuento'=>$request->Descuento,'horasRenta'=>$request->horasRenta,
                    'tipoVehiculos_id'=>$request->tipoVehiculos_id);

        $vehiculo = Vehiculos::create($datos);
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
    public function show(Vehiculos $vehiculos,$id)
    {
        //
        $vehiculo = Vehiculos::where('id','=',$id)->with('Fotos')->first();
        $rol = Session::get('user_session')[1];
        $fotos = $vehiculo['fotos'];
        return view('vehiculos.vehiculodetalle',compact('rol','vehiculo','fotos'));
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
           $precioDescuento =$request->precioRenta - (($request->precioRenta * ($request->Descuento * 0.01)));

        $datos = array('Nombre'=>$request->Nombre,'Descripcion'=>$request->Descripcion,
                    'precioRenta'=>$request->precioRenta,'precioDescuento'=>$precioDescuento,
                    'Descuento'=>$request->Descuento,'horasRenta'=>$request->horasRenta,
                    'tipoVehiculos_id'=>$request->tipoVehiculos_id);
        $vehiculo = Vehiculos::find($request->idv);
        $vehiculo->update($datos);
        $arregloEliminaFoto = explode(',', $request->idfot);
        foreach ($arregloEliminaFoto as $foto ) {
            Fotos::destroy($foto);
        }
        $arrFotos = array('Foto'=>"",'vehiculos_id'=>$vehiculo->id);

      $contFoto =  $request->nvafotos;
        for($i=1; $i<=$contFoto; $i++)
        {
            $imagen = $request->file('foto'.$i);
            $nameImage = $imagen->getClientOriginalName();
            $arrFotos['Foto'] = $nameImage;
            Fotos::create($arrFotos);
            $imagen->move('fotos',$nameImage);
        }

      return redirect()->route('vehiculos.index')->with('mensaje','Modificación exitosa');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehiculos  $vehiculos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculos $vehiculos,$id)
    {   
        $vehiculos->destroy($id);
        return redirect()->route('vehiculos.index')->with('mensaje','Vehiculo Eliminado');
    }

    public function datos(Request $request)
    {
     if($request->isMethod('post'))
        {
        $vehiculos = Vehiculos::find($request->id);
        $tipos = TipoVehiculos::all();

            $i=0;
            $datos = array('id'=>$vehiculos->id,'nombre'=>$vehiculos->Nombre,'urlElim'=>route('vehiculos.destroy',$vehiculos->id),'urlMod'=>route('vehiculos.update',$vehiculos->id),
            'descripcion'=>$vehiculos->Descripcion,'renta'=>$vehiculos->precioRenta,'precioDescuento'=>$vehiculos->precioDescuento,'descuento'=>$vehiculos->Descuento,'horas'=>$vehiculos->horasRenta,'tipo'=>$vehiculos->tipoVehiculos_id);
            $fotos = array();
        foreach ($vehiculos->fotos as $foto) {
            
            $fotos[$i]['nombre'] = $foto->Foto;
            $fotos[$i]['id'] = $foto->id;
            $i++;
        }

      $data = array($datos,$fotos,$tipos);

      //  return $data[1][1]['id'];
        return json_encode($data,JSON_FORCE_OBJECT);
        }
    }

    public function busqueda(Request $request)
    {
        $tipoVehiculos = TipoVehiculos::all();
        $vehiculos = Vehiculos::where('Nombre','LIKE','%'.$request->nombre.'%')->with('Fotos')->get();
        #$rol = Session::get('user_session')[1];
        return view('vehiculos.index',compact('vehiculos','tipoVehiculos'));
    }

    public function catalogo()
    {   
        $vehiculos = Vehiculos::with('Fotos')->with('TipoVehiculo')->get();
        //$tipoVehiculos = TipoVehiculos::all();
        $rol = Session::get('user_session')[1];
        $vehiculo = $vehiculos[0];
        //dd($vehiculos[0]['tipoVehiculo']['tipo']);
        //dd(count($vehiculo['fotos']));
        if(!empty($vehiculos)){

            return view('vehiculos.catalogo', compact('vehiculos','rol'));
        }else{
            return route('/');
        }
    }

    public function BusquedaVehiculos(Request $request){
        $tipoVehiculos = TipoVehiculos::all();
        $idtipoVehiculo=0;
        foreach ($tipoVehiculos as $tipoVehiculo) {
            if($tipoVehiculo['tipo'] == $request->nombre)
                $idtipoVehiculo = $tipoVehiculo['id'];
        }

        $Vehiculos = Vehiculos::where('tipoVehiculos_id','=',$idtipoVehiculo)->with('Fotos')->with('TipoVehiculo')->get();
        //$vehiculos = Vehiculos::where('Nombre','LIKE','%'.$request->nombre.'%')->with('Fotos')->with('TipoVehiculo')->get();
        /*    $data = 4;
            if($request->isMethod('post')){
                $data = 0;
            }
            else{
                if($request->nombre == 'misael')
                    $data = 1;
                else
                    $data = 5;
            }*/
        return json_encode($Vehiculos,JSON_FORCE_OBJECT);
    }
}
