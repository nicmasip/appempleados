@extends('base')

@section('card-title')
    <h3>{{ $page }}</h3>
    <p class="text-sm mb-0">
        <span class="font-weight-bold mt-2">Aquí puede insertar nuevos empleados, indicando su email, teléfono,<br>fecha de contratación, puesto y departamento.</span>
    </p>
    <p class="text-sm mb-0">
        <span class="font-weight-bold mt-2">Puede indicar si dicho empleado es jefe de su departamento.</span>
    </p>
    <br>
    
    @if(Session::has('message'))
    <div class="m-4 alert alert-{{ session()->get('type') }} text-white" role="alert">
        {{ session()->get('message') }}
    </div>
    @endif
    
    <form action="{{ url('empleado') }}" method="post">
      @csrf
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input name="nombre" type="text" class="form-control border p-2 mb-2" value="{{ old('nombre') }}" placeholder="Nombre" minlength="1" maxlength="200" required>
      </div>
      <div class="form-group">
        <label for="apellidos">Apellidos:</label>
        <input name="apellidos" type="text" class="form-control border p-2 mb-2" value="{{ old('apellidos') }}" placeholder="Apellidos" minlength="1" maxlength="200" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input name="email" type="email" class="form-control border p-2 mb-2" value="{{ old('email') }}" placeholder="Email" minlength="3" maxlength="64" required>
      </div>
      <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input name="telefono" type="tel" class="form-control border p-2 mb-2" value="{{ old('telefono') }}" placeholder="Teléfono" minlength="8" maxlength="11" required>
      </div>
      <div class="form-group">
        <label for="fechacontrato">Fecha de contrato:</label>
        <input name="fechacontrato" type="date" class="form-control border p-2 mb-2" value="{{ old('fechacontrato') }}" placeholder="Fecha de contrato" required>
      </div>
      <div class="form-group">
        <label for="idpuesto">Puesto:</label>
        <br>
        <select class="form-select" name="idpuesto">
            <option selected disabled value="">&nbsp;</option>
            @foreach ($puestos as $puesto)
                <option value="{{ $puesto->id }}">{{ $puesto->nombre ?? 'No tiene puesto' }}</option>
            @endforeach
        </select>
        <br>
      </div>
      <div class="form-group">
        <label for="iddepartamento">Departamento:</label>
        <br>
        <select class="form-select" name="iddepartamento" required>
            <option selected disabled value="">&nbsp;</option>
            @foreach ($departamentos as $departamento)
                <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
            @endforeach
        </select>
        <br>
      </div>
      <div class="form-check">
          <br>
          <input name="idempleadojefe" type="checkbox" class="form-check-input">
          <label for="idempleadojefe" class="form-check-label" for="exampleCheck1">Marcar si el empleado es jefe de departamento.</label>
          <br>
      </div>
      <button type="submit" class="btn btn-primary mt-3 mb-5">Crear empleado</button>
    </form>
    
    <a href="{{ url('empleado') }}">
        &larr; Volver
    </a>
@endsection