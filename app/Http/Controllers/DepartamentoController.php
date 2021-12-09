<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Empleado;
use App\Models\Puesto;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['page'] = 'Departamentos';
        $data['departamentos'] = Departamento::all();
        $data['empleados'] = Empleado::all();
        return view('departamento.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['page'] = 'Departamentos';
        $data['empleados'] = Empleado::all();
        return view('departamento.create')->with($data);
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
        $data['message'] = 'Se ha insertado correctamente un departamento nuevo.';
        $data['type'] = 'success';
        $departamento = new Departamento($request->all());
        $departamentos = Departamento::all();
        $result = true;
        foreach($departamentos as $d){
            if($d->nombre == $request->input('nombre')){
                $result = false;
            }
        }
        try {
            if($result){
                $result = $departamento->save();
            }
        } catch(Exception $e) {
            $result = false;
        }
        if(!$result) {
            $data['message'] = 'El departamento no se ha podido insertar correctamente.';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        return redirect('departamento')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Departamento $departamento)
    {
        $data = [];
        $data['page'] = 'Departamentos';
        $data['departamento'] = $departamento;
        $data['empleados'] = Empleado::all();
        $data['puestos'] = Puesto::all();
        return view('departamento.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamento $departamento)
    {
        $data = [];
        $data['page'] = 'Departamentos';
        $data['departamento'] = $departamento;
        $data['empleados'] = Empleado::all();
        return view('departamento.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departamento $departamento)
    {
        $data = [];
        $data['message'] = 'Se ha editado correctamente el departamento de ' . $departamento->nombre . '.';
        $data['type'] = 'success';
        $departamentos = Departamento::all();
        $result = true;
        foreach($departamentos as $d){
            if($d->nombre == $request->input('nombre') && $d->id != $departamento->id){
                $result = false;
            }
        }
        try {
            if($result){
                $result = $departamento->update($request->all());
            }
        } catch(Exception $e) {
            $result = false;
        }
        if(!$result) {
            $data['message'] = 'El departamento de ' . $departamento->nombre . ' no se ha podido editar correctamente.';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        return redirect('departamento')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
        $data = [];
        $data['message'] = 'El departamento de ' . $departamento->nombre . ' ha sido borrado.';
        $data['type'] = 'success';
        $empleados = Empleado::all();
        try {
            $departamento->update(['idempleadojefe' => null]);
            foreach($empleados as $empleado){
                if($departamento->id == $empleado->iddepartamento){
                     $empleado->delete();               
                }
            }
            $departamento->delete();
        } catch(\Exception $e) {
            $data['message'] = 'El departamento de ' . $departamento->nombre . ' NO ha sido borrado.';
            $data['type'] = 'danger';
        }
        return redirect('departamento')->with($data);
    }
}
