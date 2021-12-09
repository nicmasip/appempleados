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
          <p>¿Confirmar borrado del empleado <span id="deleteEmpleadoNombre">XXX</span> con teléfono <span id="deleteEmpleadoTelefono">YYY</span>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <form id="modalDeleteResourceForm" action="" method="post">
              @method('delete')
              @csrf
              <input type="submit" class="btn btn-primary" value="Borrar empleado"/>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('card-title')
    <h3>{{ $page }}</h3>
    <p class="text-sm mb-0 mt-2">
        <span class="font-weight-bold">Estos son los empleados que gestiona la aplicación, con su email,<br>teléfono, fecha de contrato, puesto y departamento.</span>
    </p>
    <p class="text-sm mb-0 mt-2">
        <span class="font-weight-bold">Además, viene indicado si dicho empleado es jefe de su departamento.</span>
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
              Nombre
            </th>
            <th
              class="
                text-center text-uppercase text-secondary text-xs
                font-weight-bolder
                opacity-7
              "
            >
              Apellidos
            </th>
            <th
              class="
                text-center text-uppercase text-secondary text-xs
                font-weight-bolder
                opacity-7
              "
            >
              Email
            </th>
            <th
              class="
                text-center text-uppercase text-secondary text-xs
                font-weight-bolder
                opacity-7
              "
            >
              Teléfono
            </th>
            <th
              class="
                text-center text-uppercase text-secondary text-xs
                font-weight-bolder
                opacity-7
              "
            >
              Fecha de contrato
            </th>
            <th
              class="
                text-center text-uppercase text-secondary text-xs
                font-weight-bolder
                opacity-7
              "
            >
              Puesto
            </th>
            <th
              class="
                text-center text-uppercase text-secondary text-xs
                font-weight-bolder
                opacity-7
              "
            >
              Departamento
            </th>
            <th
              class="
                text-center text-uppercase text-secondary text-xs
                font-weight-bolder
                opacity-7
              "
            >
              ¿Jefe?
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
              Borrar empleado
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($empleados as $empleado)
          <tr>
            <td class="text-center text-sm">
              <span class="text-xs font-weight-bold">
                {{ $empleado->nombre }}
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                {{ $empleado->apellidos }}
              </span>
            </td>
            <td class="text-center text-sm">
              <span class="text-xs font-weight-bold">
                {{ $empleado->email }}
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                {{ $empleado->telefono }}
              </span>
            </td>
            <td class="text-center text-sm">
              <span class="text-xs font-weight-bold">
                {{ $empleado->fechacontrato }}
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                @foreach($puestos as $puesto)
                  @if($empleado->idpuesto == $puesto->id)
                    {{ $puesto->nombre }}
                  @endif
                @endforeach
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                @foreach($departamentos as $departamento)
                  @if($empleado->iddepartamento == $departamento->id)
                    {{ $departamento->nombre }}
                  @endif
                @endforeach
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                @foreach($departamentos as $departamento)
                  @if($empleado->iddepartamento == $departamento->id)
                    @if($departamento->idempleadojefe == $empleado->id)
                      {{ 'Sí es jefe' }}
                    @else
                      {{ 'No es jefe' }}
                    @endif
                  @endif
                @endforeach
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                <a href="{{ url('empleado/' . $empleado->id) }}">Mostrar</a>
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                <a href="{{ url('empleado/' . $empleado->id . '/edit') }}">Editar</a>
              </span>
            </td>
            <td class="align-middle text-center text-sm">
              <span class="text-xs font-weight-bold">
                <a href="javascript: void(0);" data-name="{{ $empleado->nombre . ' ' . $empleado->apellidos }}" data-tel="{{ $empleado->telefono }}" data-url="{{ url('empleado/' . $empleado->id) }}" data-bs-toggle="modal" data-bs-target="#modalDelete">Borrar</a>
              </span>
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>
@endsection

@section('card-after-table')
  <div class="p-4 pb-0">
        <a href="{{ url('empleado/create') }}" class="btn btn-primary">Insertar nuevo empleado</a>
  </div>
@endsection

@section('js')
  <script src="{{ url('assets/js/deleteEmpleado.js') }}"></script>
@endsection