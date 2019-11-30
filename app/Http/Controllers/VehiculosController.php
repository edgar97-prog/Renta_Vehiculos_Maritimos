<?php

namespace App\Http\Controllers;

use App\Vehiculos;
use App\Fotos;
use App\Usuarios;
use App\TipoVehiculos;
use App\Favoritos;
use App\Rentas;
use App\Dolar;
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
        $vehiculos = Vehiculos::with('Fotos')->with('TipoVehiculo')->paginate(8);
  
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
          'horasRenta'=>'required','tipoVehiculos_id'=>'required','num_personas'=>'required'],['Nombre.required'=>'El nombre es requerido',
          'Foto.required'=>'Debe elegir por lo menos una imagen para mostrar a los clientes',
          'Descripcion.required'=>'Necesita agregar una descripción',
          'horasRenta.required'=>'Debe agregar la(s) hora(s) minima(s) de renta',
          'precioRenta.required'=>'Debe agregar un precio de renta',
          'tipoVehiculos_id.required'=>'Debe seleccionar un tipo de vehiculo',
          'num_personas.required'=>'El número de personas es requerido']);

        $precioDescuento =$request->precioRenta - (($request->precioRenta * ($request->Descuento * 0.01)));

        $datos = array('Nombre'=>$request->Nombre,'Descripcion'=>$request->Descripcion,
                    'precioRenta'=>$request->precioRenta,'precioDescuento'=>$precioDescuento,
                    'Descuento'=>$request->Descuento,'horasRenta'=>$request->horasRenta,
                    'tipoVehiculos_id'=>$request->tipoVehiculos_id,'num_personas'=>$request->num_personas);

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
        $vehiculo = Vehiculos::where('id',$id)->with('Fotos')->with(['Favoritos'=> function($q){$q->where('Correo_id',Session::get('user_session')[0]);}])->first();
        if(empty($vehiculo))
          return redirect('/catalogo');
        $fotos = $vehiculo['fotos'];
        if(!Session::has("user_session")){
          $rol = 1;
          $R = false;
          $hora = 0;
          $rentado = "";
          return view('vehiculos.vehiculodetalle',compact('rol','vehiculo','fotos','R','rentado','hora'));
        }else{
            $rol = Session::get('user_session')[1];
            $rentado = Rentas::where("Correo_id",Session::get('user_session')[0])->where("Vehiculo_id",$id)->where("estatus","E")->first();
            if(!empty($rentado)){ //Si lo renté
              $R = true;
              $hora = intval(substr($rentado['fechaIni'], 11,12));
              $rentado['fechaIni'] = substr($rentado['fechaIni'], 0,10);
              return view('vehiculos.vehiculodetalle',compact('rol','vehiculo','fotos','R','rentado','hora'));
            }
            else{
              $R = false;
              $hora = 0;
              $hrsRentadas = Rentas::where("Vehiculo_id",$id)->where("estatus","E")->orderBy("fechaIni")->get(["fechaIni","hrsRenta"]);
              if(empty($hrsRentadas[0])){
                return view('vehiculos.vehiculodetalle',compact('rol','vehiculo','fotos','R','rentado','hora'));
              }
              else{
                $hrsRentadas[0] = json_encode($hrsRentadas[0],JSON_FORCE_OBJECT);
                return view('vehiculos.vehiculodetalle',compact('rol','vehiculo','fotos','R','rentado','hora','hrsRentadas'));
              }
            } 
        }
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
      $precioDescuento =$request->precioRenta - (($request->precioRenta * ($request->Descuento * 0.01)));
      $datos = array('Nombre'=>$request->Nombre,'Descripcion'=>$request->Descripcion,
                  'precioRenta'=>$request->precioRenta,'precioDescuento'=>$precioDescuento,
                  'Descuento'=>$request->Descuento,'horasRenta'=>$request->horasRenta,
                  'tipoVehiculos_id'=>$request->tipoVehiculos_id,'num_personas'=>$request->num_personas);
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
            'descripcion'=>$vehiculos->Descripcion,'renta'=>$vehiculos->precioRenta,'precioDescuento'=>$vehiculos->precioDescuento,'descuento'=>$vehiculos->Descuento,'horas'=>$vehiculos->horasRenta,'tipo'=>$vehiculos->tipoVehiculos_id,
            'num_personas'=>$vehiculos->num_personas);
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
        $vehiculos = Vehiculos::where('Nombre','LIKE','%'.$request->nombre.'%')->with('Fotos')->paginate(8);
        #$rol = Session::get('user_session')[1];
        return view('vehiculos.index',compact('vehiculos','tipoVehiculos'));
    }

    public function catalogo(Request $request)
    {   
        $rol = Session::get('user_session')[1];
        $TipoVehiculos = TipoVehiculos::all();
        $Dolar = Dolar::all();
        $precioDolar=$Dolar[0]['valor'];
        if($Dolar[0]['permitir'] == 1){
         $precioDolar = self::obtenDivisa(1,'USD','MXN');
         $a = Dolar::where('permitir','=','1')->update(array('valor' => $precioDolar,'permitir' => 0));
        }
       //dd($precioDolar);

        if(isset($request->nombreVehiculoBuscar)){
            $vehiculos = Vehiculos::where('Nombre','LIKE','%'.$request->nombreVehiculoBuscar.'%')->with('Fotos')->with('TipoVehiculo')
              ->with(['Favoritos'=> function($q){$q->where('Correo_id',Session::get('user_session')[0]);}])->get();//SI ENCUENTRA ALGO PARECIDO

            if(count($vehiculos) == 0){
                $vehiculos = Vehiculos::with('Fotos')->with('TipoVehiculo')
                ->with(['Favoritos'=> function($q){$q->where('Correo_id',Session::get('user_session')[0]);}])->paginate(9);
                if(!empty($vehiculos)){
                    return view('vehiculos.catalogo', compact('vehiculos','rol','TipoVehiculos','precioDolar'));
                }else{
                    return route('/');
                }
            }
            else{
                if(!empty($vehiculos)){

                    return view('vehiculos.catalogo', compact('vehiculos','rol','TipoVehiculos','precioDolar'));
                }else{
                    return route('/');
                }
            }
        }
        else{
            $vehiculos = Vehiculos::with('Fotos')->with('TipoVehiculo')
            ->with(['Favoritos'=> function($q){$q->where('Correo_id',Session::get('user_session')[0]);}])->paginate(9);
            //$tipoVehiculos = TipoVehiculos::all();
            //dd($vehiculos[0]['tipoVehiculo']['tipo']);
            //dd(count($vehiculo['fotos']));
            //dd($vehiculos);
            if(!empty($vehiculos)){
                return view('vehiculos.catalogo', compact('vehiculos','rol','TipoVehiculos','precioDolar'));
            }else{
                return route('/');
            }
        }
    }


    public function obtenDivisa($cantidad,$de,$a)
    {
      $key = '29a42c8782196b433c76';
      $de = urlencode($de);
      $a = urlencode($a);
      $query = "{$de}_{$a}";
      $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$key}");
      $obj = json_decode($json,true);
      $val = floatval($obj["$query"]);

      $total = $val * $cantidad;

      return number_format($total, 2, '.', '');
    }
    public function pruebaDolar()
    {

        
        echo self::obtenDivisa(1,'USD','MXN');
      

    }
    public function rentas(Request $request)
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
        return $arregloV['estatus'];
      }
      $newRenta = Rentas::create($arregloV);
      return 'E';
    }

    public function mostrarFavoritos()
    {
        $Dolar = Dolar::all();
        $precioDolar=$Dolar[0]['valor'];
        $rol = Session::get('user_session')[1];
         $vehiculos = Vehiculos::with('Fotos')->with('TipoVehiculo')
         ->with('Favoritos')->join('favoritos','favoritos.Vehiculo_id','=','vehiculos.id')
        ->where('favoritos.Correo_id','=',Session::get('user_session')[0])
        ->get();
        return view('vehiculos.favoritos',compact('vehiculos','rol','precioDolar'));
    }

    public function muestraRentas()
    {

      $datosRenta = Rentas::join('usuarios','usuarios.Correo','=','rentas.Correo_id')
      ->join('vehiculos','vehiculos.id','=','rentas.Vehiculo_id')
      ->select('rentas.id','usuarios.Correo','usuarios.ApellidoP','usuarios.ApellidoM','usuarios.Nombre AS Nombre_Usuario',
        'vehiculos.Nombre','vehiculos.precioRenta','rentas.fechaIni','rentas.hrsRenta','rentas.estatus')->get();
      return view('rentas',compact('datosRenta'));
    }

    public function administraRenta($id,$accion)
    {
        if($accion == 1)
        {
          $estado = 'A';
        }
        else
        {
          $estado = 'C';
        }

        $renta = Rentas::find($id);
        $renta->estatus = $estado;
        $renta->update();

        return redirect('/muestra/rentas')->with('mensaje','Actualización realizada');
    }
}
