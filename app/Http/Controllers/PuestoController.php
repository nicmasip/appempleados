<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use App\Models\Departamento;
use App\Models\Empleado;
use Illuminate\Http\Request;

class PuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['page'] = 'Puestos';
        $data['puestos'] = Puesto::all();
        return view('puesto.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['page'] = 'Puestos';
        return view('puesto.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];
        $data['message'] = 'Se ha insertado correctamente un puesto nuevo.';
        $data['type'] = 'success';
        $puesto = new Puesto($request->all());
        $puestos = Puesto::all();
        $result = true;
        foreach($puestos as $p){
            if($p->nombre == $request->input('nombre')){
                $result = false;
            }
        }
        if($request->input('maximo') < $request->input('minimo')){
            $result = false;
        }
        try {
            if($result){
                $result = $puesto->save();
            }
        } catch(Exception $e) {
            $result = false;
        }
        if(!$result) {
            $data['message'] = 'El puesto no se ha podido insertar correctamente.';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        return redirect('puesto')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function show(Puesto $puesto)
    {
        $data = [];
        $data['page'] = 'Puestos';
        $data['puesto'] = $puesto;
        $data['empleados'] = Empleado::all();
        $data['departamentos'] = Departamento::all();
        return view('puesto.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function edit(Puesto $puesto)
    {
        $data = [];
        $data['page'] = 'Puestos';
        $data['puesto'] = $puesto;
        return view('puesto.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Puesto $puesto)
    {
        $data = [];
        $data['message'] = 'Se ha editado correctamente el puesto ' . $puesto->nombre . '.';
        $data['type'] = 'success';
        $puestos = Puesto::all();
        $result = true;
        foreach($puestos as $p){
            if($p->nombre == $request->input('nombre') && $p->id != $puesto->id){
                $result = false;
            }
        }
        if($request->input('maximo') < $request->input('minimo')){
            $result = false;
        }
        try {
            if($result){
                $result = $puesto->update($request->all());
            }
        } catch(Exception $e) {
            $result = false;
        }
        if(!$result) {
            $data['message'] = 'El puesto ' . $puesto->nombre . ' no se ha podido editar correctamente.';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        return redirect('puesto')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Puesto  $puesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Puesto $puesto)
    {
        $data = [];
        $data['message'] = 'El puesto ' . $puesto->nombre . ' ha sido borrado.';
        $data['type'] = 'success';
        try {
            $puesto->delete();
        } catch(\Exception $e) {
            $data['message'] = 'El puesto ' . $puesto->nombre . ' NO ha sido borrado.';
            $data['type'] = 'danger';
        }
        return redirect('puesto')->with($data);
    }
}
