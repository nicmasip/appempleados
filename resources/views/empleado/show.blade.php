@extends('base')

@section('card-title')
    <h3>{{ $page }}</h3>
    <p class="text-sm mb-0">
        <span class="font-weight-bold mt-2">En esta página puede ver la información del empleado {{ $empleado ->nombre . ' ' . $empleado->apellidos}} con teléfono {{ $empleado->telefono }}.</span>
    </p>
    <div class="table mt-5">
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
                  Datos
                </th>
                <th
                  class="
                    text-center text-uppercase text-secondary text-xs
                    font-weight-bolder
                    opacity-7
                  "
                >
                  Empleado
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    Nombre:
                  </span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    {{ $empleado->nombre }}
                  </span>
                </td>
              </tr>
              <tr>
                <td class="text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    Apellidos:
                  </span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    {{ $empleado->apellidos }}
                  </span>
                </td>
              </tr>
              <tr>
                <td class="text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    Email:
                  </span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    {{ $empleado->email }}
                  </span>
                </td>
              </tr>
              <tr>
                <td class="text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    Teléfono:
                  </span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    {{ $empleado->telefono }}
                  </span>
                </td>
              </tr>
              <tr>
                <td class="text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    Fecha de contrato:
                  </span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    {{ $empleado->fechacontrato }}
                  </span>
                </td>
              </tr>
              <tr>
                <td class="text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    Puesto:
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
              </tr>
              <tr>
                <td class="text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    Departamento:
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
              </tr>
              <tr>
                <td class="text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    ¿Jefe?
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
              </tr>
            </tbody>
        </table>
    </div>
@endsection

@section('card-after-table')
    <div class="p-4 mt-2">
        <a href="{{ url('empleado') }}">
            &larr; Volver
        </a>
    </div>
@endsection