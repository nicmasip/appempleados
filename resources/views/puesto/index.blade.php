@extends('base')

@section('modal')
  <div class="modal" id="modalDelete" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirm delete</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <p>¿Confirmar borrado del puesto <span id="deletePuesto">XXX</span>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <form id="modalDeleteResourceForm" action="" method="post">
              @method('delete')
              @csrf
              <input type="submit" class="btn btn-primary" value="Borrar puesto"/>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('card-title')
    <h3>{{ $page }}</h3>
    <p class="text-sm mb-0">
        <span class="font-weight-bold mt-2">Estos son los puestos que pueden ocupar los empleados con su salario mínimo y máximo.</span>
    </p>
    <br>
@endsection

@section('card-table')
    @if(Session::has('message'))
    <div class="m-4 alert alert-{{ session()->get('type') }} text-white" role="alert">
        {{ session()->get('message') }}
    </div>
    @endif

    <table class="table align-items-center mb-0">
        <thead>
          <tr>
            <th
              class="
                text-center text-uppercase text-secondary text-xs
                font-weight-bolder
                opacity-7
              "
            >
              Nombre del puesto
            </th>
            <th
              class="
                text-center text-uppercase text-secondary text-xs
                font-weight-bolder
                opacity-7
              "
            >
              Salario mínimo
            </th>
            <th
              class="
                text-center text-uppercase text-secondary text-xs
                font-weight-bolder
                opacity-7
              "
            >
              Salario máximo
            </th>
            <th
              class="
                text-center text-uppercase text-secondary text-xs
                font-weight-bolder
                opacity-7
              "
            >
              Más información
            </th>
            <th
              class="
                text-center text-uppercase text-secondary text-xs
                font-weight-bolder
                opacity-7
              "
            >
              Editar información
            </th>
            <th
              class="
                text-center text-uppercase text-secondary text-xs
                font-weight-bolder
                opacity-7
              "
            >
              Borrar puesto
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($puestos as $puesto)
          <tr>
            <td class="text-center text-sm">
              <span class="text-xs font-weight-bold">
                {{ $puesto->nombre }}
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                {{ $puesto->minimo }}€
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                {{ $puesto->maximo }}€
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                <a href="{{ url('puesto/' . $puesto->id) }}">Mostrar</a>
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                <a href="{{ url('puesto/' . $puesto->id . '/edit') }}">Editar</a>
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                <a href="javascript: void(0);" data-name="{{ $puesto->nombre }}" data-url="{{ url('puesto/' . $puesto->id) }}" data-bs-toggle="modal" data-bs-target="#modalDelete">Borrar</a>
              </span>
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>
@endsection

@section('card-after-table')
  <div class="p-4 pb-0">
        <a href="{{ url('puesto/create') }}" class="btn btn-primary">Crear nuevo puesto</a>
  </div>
@endsection

@section('js')
  <script src="{{ url('assets/js/deletePuesto.js') }}"></script>
@endsection