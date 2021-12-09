<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Puesto;
use App\Models\Departamento;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['page'] = 'Empleados';
        $data['empleados'] = Empleado::all();
        $data['puestos'] = Puesto::all();
        $data['departamentos'] = Departamento::all();
        return view('empleado.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['page'] = 'Empleados';
        $data['puestos'] = Puesto::all();
        $data['departamentos'] = Departamento::all();
        return view('empleado.create')->with($data);
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
        $data['message'] = 'Se ha insertado correctamente un empleado nuevo.';
        $data['type'] = 'success';
        $empleado = new Empleado($request->all());
        $departamentos = Departamento::all();
        $result = true;
        try {
            $result = $empleado->save();
            foreach($departamentos as $d){
                if($d->id == $request->input('iddepartamento')){
                    $departamento = $d;
                }
            }
            if($request->idempleadojefe == 'on' && $departamento->idempleadojefe == null){
                $departamento->idempleadojefe = $empleado->id;
                $idCambiado = $departamento->idempleadojefe++;
                $departamento->update(['idempleadojefe' => $idCambiado]);
                $empleado->update(['id' => $idCambiado]);
            }
            elseif($request->idempleadojefe == 'on' && $departamento->idempleadojefe != null){
                $empleado->delete();
                $data['message'] = 'El empleado no se ha podido insertar correctamente.';
                $data['type'] = 'danger';
                return back()->withInput()->with($data);
            }
        } catch(Exception $e) {
            $result = false;
        }
        if(!$result) {
            $data['message'] = 'El empleado no se ha podido insertar correctamente.';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        return redirect('empleado')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        $data = [];
        $data['page'] = 'Empleados';
        $data['empleado'] = $empleado;
        $data['departamentos'] = Departamento::all();
        $data['puestos'] = Puesto::all();
        return view('empleado.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        $data = [];
        $data['page'] = 'Empleados';
        $data['empleado'] = $empleado;
        $data['departamentos'] = Departamento::all();
        $data['puestos'] = Puesto::all();
        return view('empleado.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        $data = [];
        $data['message'] = 'Se ha editado correctamente el empleado ' . $empleado->nombre . ' ' . $empleado->apellidos . ' con teléfono ' . $empleado->telefono . '.';
        $data['type'] = 'success';
        $empleados = Empleado::all();
        $result = true;
        foreach($empleados as $e){
            if($e->telefono == $request->input('telefono') && $e->telefono != $empleado->telefono){
                $result = false;
            }
        }
        
        $departamentos = Departamento::all();
        $departamento = Departamento::find($empleado->iddepartamento);
        $departamentoDistinto = Departamento::find($request->input('iddepartamento'));

        if($request->idempleadojefe == 'on'){                           //Si está marcado
            if($departamentoDistinto->nombre == $departamento->nombre){ //Si el departamento original es igual al nuevo departamento a actualizar
                if($departamento->idempleadojefe == null){              //Si no hay jefe en dicho departamento
                    $departamento->idempleadojefe = $empleado->id;      //Hago que el empleado a actualizar sea jefe del departamento original
                }
                else{ //Si ya hay jefe en el departamento
                    if($empleado->id != $departamento->idempleadojefe){ //Si el empleado que estoy editando no es jefe
                        $result = false; //Impido que se pueda sobreescribir
                    }
                }
            }
            else{ //Si el departamento original no es igual al nuevo departamento a actualizar
                if($departamento->idempleadojefe == $empleado->id){    //Si el empleado ya es jefe en del departamento original
                    if($departamentoDistinto->idempleadojefe != null){ //Si ya hay jefe en el departamento nuevo
                        $result = false; //Impido que se pueda sobreescribir
                    }
                    else{ //Si no hay jefe en el departamento nuevo
                        
                        $departamentoDistinto->idempleadojefe = $empleado->id;  //Hago que el empleado a actualizar sea jefe del departamento nuevo
                        $departamento->idempleadojefe = null;                   //Hago que el departamento original no tenga jefe
                    } 
                }
                else{ //Si el empleado no es jefe en del departamento original
                    if($departamentoDistinto->idempleadojefe != null){ //Si ya hay jefe en el departamento nuevo
                        $result = false; //Impido que se pueda sobreescribir
                    }
                    else{ //Si no hay jefe en el departamento nuevo
                        $departamentoDistinto->idempleadojefe = $empleado->id;  //Hago que el empleado a actualizar sea jefe del departamento nuevo
                    }
                }
            }
        }
        else{ //Si no está marcado
            if($departamentoDistinto->nombre == $departamento->nombre){ //Si el departamento original es igual al nuevo departamento a actualizar
                if($departamento->idempleadojefe != null){              //Si ya hay jefe en el departamento
                    if($empleado->id != $departamento->idempleadojefe){ //Si el empleado que estoy editando no es jefe
                        $result = false; //Impido que se pueda sobreescribir
                    }
                    else{ //Si el jefe es el mismo que estoy editando
                        $departamento->idempleadojefe = null;
                    }
                }
            }
            else{ //Si el departamento original no es igual al nuevo departamento a actualizar
                $departamento->idempleadojefe = null;           //Hago que el departamento original no tenga jefe
                $departamentoDistinto->idempleadojefe = null;   //Hago que el departamento nuevo no tenga jefe
            }
        }
        
        try {
            if($result){
                $departamento->update(['idempleadojefe' => $departamento->idempleadojefe]);
                if($departamentoDistinto->nombre != $departamento->nombre){
                    $departamentoDistinto->update(['idempleadojefe' => $departamentoDistinto->idempleadojefe]);
                }
                $result = $empleado->update($request->all());
            }
        } catch(Exception $e) {
            $result = false;
        }
        if(!$result) {
            $data['message'] = 'El empleado ' . $empleado->nombre . ' ' . $empleado->apellidos . ' con teléfono ' . $empleado->telefono . ' no se ha podido editar correctamente.';
            $data['type'] = 'danger';
            return back()->withInput()->with($data);
        }
        return redirect('empleado')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        $data = [];
        $data['message'] = 'El empleado ' . $empleado->nombre . ' ' . $empleado->apellidos . ' con teléfono ' . $empleado->telefono .  ' ha sido borrado.';
        $data['type'] = 'success';
        $departamento = Departamento::find($empleado->iddepartamento);
        try {
            if($departamento->id == $empleado->iddepartamento){
                $departamento->update(['idempleadojefe' => null]);
            }
            $empleado->delete();
        } catch(\Exception $e) {
            $data['message'] = 'El empleado ' . $empleado->nombre . ' ' . $empleado->apellidos . ' con teléfono ' . $empleado->telefono .  ' NO ha sido borrado.';
            $data['type'] = 'danger';
        }
        return redirect('empleado')->with($data);
    }
}
