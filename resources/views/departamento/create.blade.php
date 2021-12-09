@extends('base')

@section('card-title')
    <h3>{{ $page }}</h3>
    <p class="text-sm mb-0">
        <span class="font-weight-bold mt-2">Aquí puede insertar nuevos departamentos, indicando su localización.</span>
    </p>
    <br>
    
    @if(Session::has('message'))
    <div class="m-4 alert alert-{{ session()->get('type') }} text-white" role="alert">
        {{ session()->get('message') }}
    </div>
    @endif
    
    <form action="{{ url('departamento') }}" method="post">
      @csrf
      <div class="form-group">
        <label for="nombre">Nombre del departamento:</label>
        <input name="nombre" type="text" class="form-control border p-2 mb-2" value="{{ old('nombre') }}" placeholder="Nombre del departamento" minlength="1" maxlength="200" required>
      </div>
      <div class="form-group">
        <label for="localizacion">Localización:</label>
        <input name="localizacion" type="string" class="form-control border p-2 mb-2" value="{{ old('localizacion') }}" placeholder="Localización" minlength="1" maxlength="200" required>
      </div>
      <button type="submit" class="mt-4 btn btn-primary mb-5">Crear departamento</button>
    </form>
    
    <a href="{{ url('departamento') }}">
        &larr; Volver
    </a>
@endsection