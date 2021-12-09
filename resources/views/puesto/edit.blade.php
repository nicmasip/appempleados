@extends('base')

@section('card-title')
    <h3>{{ $page }}</h3>
    <p class="text-sm mb-0">
        <span class="font-weight-bold mt-2">Aquí puede editar la información de los puestos ya existentes.</span>
    </p>
    <br>
    
    @if(Session::has('message'))
    <div class="m-4 alert alert-{{ session()->get('type') }} text-white" role="alert">
        {{ session()->get('message') }}
    </div>
    @endif
    
    <form action="{{ url('puesto/' . $puesto->id) }}" method="post">
      @csrf
      @method('put')
      <div class="form-group">
        <label for="nombre">Nombre del puesto:</label>
        <input name="nombre" type="text" class="form-control border p-2 mb-2" value="{{ old('nombre', $puesto->nombre) }}" placeholder="Nombre del puesto" minlength="1" maxlength="200" required>
      </div>
      <div class="form-group">
        <label for="minimo">Salario mínimo:</label>
        <input name="minimo" type="number" class="form-control border p-2 mb-2" value="{{ old('minimo', $puesto->minimo) }}" placeholder="Salario mínimo" min="0.01" max="9999999.99" step="0.01" required>
      </div>
      <div class="form-group">
        <label for="maximo">Salario máximo:</label>
        <input name="maximo" type="number" class="form-control border p-2 mb-3" value="{{ old('maximo', $puesto->maximo) }}" placeholder="Salario máximo" min="0.01" max="9999999.99" step="0.01" required>
      </div>
      <button type="submit" class="btn btn-primary mb-5">Editar puesto</button>
    </form>
    
    <a href="{{ url('puesto') }}">
        &larr; Volver
    </a>
@endsection 