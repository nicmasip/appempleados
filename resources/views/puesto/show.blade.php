@extends('base')

@section('card-title')
    <h3>{{ $page }}</h3>
    <p class="text-sm mb-0">
        <span class="font-weight-bold mt-2">En esta página puede ver la información del puesto {{ $puesto->nombre }} así como de empleados que lo ocupan.</span>
    </p>
    <br>
    <div class="table">
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
                  Puesto
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    Nombre del puesto:
                  </span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    {{ $puesto->nombre }}
                  </span>
                </td>
              </tr>
              <tr>
                <td class="text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    Salario mínimo:
                  </span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    {{ $puesto->minimo }}
                  </span>
                </td>
              </tr>
              <tr>
                <td class="text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    Salario máximo:
                  </span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    {{ $puesto->maximo }}
                  </span>
                </td>
              </tr>
            </tbody>
        </table>
    </div>
    <br>
    <h4>Empleados cuyo puesto es {{ $puesto->nombre }}</h4>
@endsection

@section('card-table')
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
          </tr>
        </thead>
        <tbody>
          @foreach($empleados as $empleado)
                @if($puesto->id == $empleado->idpuesto)
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
                        {{ $puesto->nombre }}
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
                  </tr>
                @endif
          @endforeach
        </tbody>
    </table>
@endsection

@section('card-after-table')
    <div class="p-4 mt-2">
        <a href="{{ url('puesto') }}">
            &larr; Volver
        </a>
    </div>
@endsection