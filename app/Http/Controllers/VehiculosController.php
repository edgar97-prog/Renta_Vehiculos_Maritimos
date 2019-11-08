<?php

namespace App\Http\Controllers;

use App\Vehiculos;
use App\Fotos;
use App\Usuarios;
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
        $this->middleware('autenticar',['only'=>['store','index','show','update','destroy','datos,','busqueda']]);
        $this->middleware('Both_user',['only'=>['store','index','show','update','destroy','datos,','busqueda']]);
    }
    public function index()
    {
        //
        $vehiculos = Vehiculos::with('Fotos')->get();
      /*  $user = Usuarios::where('Correo','=',Session::get('user_session'))->first();
        $rol = $user->rol_id;*/
        $rol = Session::get('user_session')[1];
        return view('vehiculos.index',compact('vehiculos','rol'));
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
        $vehiculo = Vehiculos::find($request->idv);
        $vehiculo->update($request->all());
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

            $i=0;
            $datos = array('id'=>$vehiculos->id,'nombre'=>$vehiculos->Nombre,'urlElim'=>route('vehiculos.destroy',$vehiculos->id),'urlMod'=>route('vehiculos.update',$vehiculos->id),
            'descripcion'=>$vehiculos->Descripcion,'renta'=>$vehiculos->precioRenta,'cantidad'=>$vehiculos->Cantidad);
            $fotos = array();
        foreach ($vehiculos->fotos as $foto) {
            
            $fotos[$i]['nombre'] = $foto->Foto;
            $fotos[$i]['id'] = $foto->id;
            $i++;
        }

      $data = array($datos,$fotos);

      //  return $data[1][1]['id'];
        return json_encode($data,JSON_FORCE_OBJECT);
        }
    }

    public function busqueda(Request $request)
    {

        $vehiculos = Vehiculos::where('Nombre','LIKE','%'.$request->nombre.'%')->with('Fotos')->get();
        #$rol = Session::get('user_session')[1];
        return view('vehiculos.index',compact('vehiculos'));
    }

    public function catalogo()
    {   
        $vehiculos = Vehiculos::with('Fotos')->get();
        $rol = Session::get('user_session')[1];
        $vehiculo = $vehiculos[0];
        //dd($vehiculo["Fotos"][0]["Foto"]);
        //dd(count($vehiculo['fotos']));
        if(!empty($vehiculos)){

            return view('vehiculos.catalogo', compact('vehiculos','rol'));
        }else{
            return route('/');
        }
    }
}
