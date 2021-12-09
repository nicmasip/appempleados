@extends('base')

@section('card-title')
    <h3>{{ $page }}</h3>
    <p class="text-sm mb-0">
        <span class="font-weight-bold mt-2">Aquí puede editar la información de los departamentos ya existentes.</span>
    </p>
    <br>
    
    @if(Session::has('message'))
    <div class="m-4 alert alert-{{ session()->get('type') }} text-white" role="alert">
        {{ session()->get('message') }}
    </div>
    @endif
    
    <form action="{{ url('departamento/' . $departamento->id) }}" method="post">
      @csrf
      @method('put')
      <div class="form-group">
        <label for="nombre">Nombre del departamento:</label>
        <input name="nombre" type="text" class="form-control border p-2 mb-2" value="{{ old('nombre', $departamento->nombre) }}" placeholder="Nombre del puesto" minlength="1" maxlength="200" required>
      </div>
      <div class="form-group">
        <label for="localizacion">Localización:</label>
        <input name="localizacion" type="text" class="form-control border p-2 mb-2" value="{{ old('localizacion', $departamento->localizacion) }}" placeholder="Localización" minlength="1" maxlength="200" required>
      </div>
      <div class="form-group">
        <label for="idempleadojefe">Jefe de departamento*:</label>
        <br>
        <select class="form-select" name="idempleadojefe">
            <option selected disabled value="">&nbsp;</option>
            <option value="{{ null }}">Este departamento no tiene jefe</option>
            @foreach ($empleados as $empleado)
                <option value="{{ $empleado->id }}">{{ $empleado->nombre . ' ' . $empleado->apellidos .  ' con el teléfono ' . $empleado->telefono }}</option>
            @endforeach
        </select>
        <br>
        <small class="form-text text-muted text-xs">*Este campo es opcional.</small>
      </div>
      <button type="submit" class="btn btn-primary mb-5 mt-4">Editar departamento</button>
    </form>
    
    <a href="{{ url('departamento') }}">
        &larr; Volver
    </a>
@endsection 