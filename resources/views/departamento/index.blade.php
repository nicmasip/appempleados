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
          <p>¿Confirmar borrado del departamento <span id="deleteDepartamento">XXX</span>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <form id="modalDeleteResourceForm" action="" method="post">
              @method('delete')
              @csrf
              <input type="submit" class="btn btn-primary" value="Borrar departamento"/>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('card-title')
    <h3>{{ $page }}</h3>
    <p class="text-sm mb-0">
        <span class="font-weight-bold mt-2">Estos son los departamentos a los que pueden pertenecer los empleados, con su<br>localización y jefe de departamento, en caso de tenerlo.</span>
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
              Nombre del departamento
            </th>
            <th
              class="
                text-center text-uppercase text-secondary text-xs
                font-weight-bolder
                opacity-7
              "
            >
              Localización
            </th>
            <th
              class="
                text-center text-uppercase text-secondary text-xs
                font-weight-bolder
                opacity-7
              "
            >
              Jefe de departamento
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
              Borrar departamento
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($departamentos as $departamento)
          <tr>
            <td class="text-center text-sm">
              <span class="text-xs font-weight-bold">
                {{ $departamento->nombre }}
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                {{ $departamento->localizacion }}
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                @if($departamento->idempleadojefe == NULL)
                      {{ 'Sin jefe' }}
                @else
                  @foreach($empleados as $empleado)
                      @if($empleado->id == $departamento->idempleadojefe)
                        {{ $empleado->nombre . ' ' . $empleado->apellidos }}
                      @endif
                  @endforeach
                @endif
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                <a href="{{ url('departamento/' . $departamento->id) }}">Mostrar</a>
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                <a href="{{ url('departamento/' . $departamento->id . '/edit') }}">Editar</a>
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                <a href="javascript: void(0);" data-name="{{ $departamento->nombre }}" data-url="{{ url('departamento/' . $departamento->id) }}" data-bs-toggle="modal" data-bs-target="#modalDelete">Borrar</a>
              </span>
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>
@endsection

@section('card-after-table')
  <div class="p-4 pb-0">
        <a href="{{ url('departamento/create') }}" class="btn btn-primary">Crear nuevo departamento</a>
  </div>
@endsection

@section('js')
  <script src="{{ url('assets/js/deleteDepartamento.js') }}"></script>
@endsection