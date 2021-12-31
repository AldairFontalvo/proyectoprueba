<?php

namespace App\Http\Controllers;

use App\Automoviles;
use Illuminate\Http\Request;

class AutomovilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $autos=Automoviles::all();
        return view('automoviles');
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
        $auto = new Automoviles;
        $auto->Auto_name=$request->nombre;
        $auto->Auto_modelo=$request->modelo;
        $auto->Auto_marca=$request->marca;
        $auto->Auto_departamento=$request->departamento;
        $auto->fechacreate=now();
        $auto->fechaUpdate=now();
        if($auto->save()){
            return $resultado = array('ErrorStatus'=>false, 'Msj'=>'Se ha guardado el automovil correctamente.');
        }else{
            return $resultado = array('ErrorStatus'=>true, 'Msj'=>'Error al intentar guardar la información del automovil de pagos.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Automoviles  $automoviles
     * @return \Illuminate\Http\Response
     */
    public function show(Automoviles $automoviles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Automoviles  $automoviles
     * @return \Illuminate\Http\Response
     */
    public function edit(Automoviles $automoviles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Automoviles  $automoviles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $auto=Automoviles::find($id);
        $auto->Auto_name=$request->nombre;
        $auto->Auto_modelo=$request->modelo;
        $auto->Auto_marca=$request->marca;
        $auto->Auto_departamento=$request->departamento;
        $auto->fechaUpdate=now();
        if($auto->save()){
            return $resultado = array('ErrorStatus'=>false, 'Msj'=>'Se ha actualizado el automovil correctamente.');
        }else{
            return $resultado = array('ErrorStatus'=>true, 'Msj'=>'Error al intentar actualizar la información del automovil.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Automoviles  $automoviles
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $auto=Automoviles::find($id);
        if($auto->delete()){
            return $resultado = array('ErrorStatus'=>false, 'Msj'=>'Se ha eliminado el automovil correctamente.');
        }else{
            return $resultado = array('ErrorStatus'=>true, 'Msj'=>'Error al intentar eliminar el automovil.');
        }
    }

    public function destroymasivo($ids)
    {
        $autos= explode(',',$ids);

        foreach($autos as $id){

            $auto=Automoviles::find($id);
            $auto->delete();
        }
        return $resultado = array('ErrorStatus'=>false, 'Msj'=>'Se han eliminado los automoviles correctamente.');
    }
}
