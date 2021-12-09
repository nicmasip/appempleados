@extends('base')

@section('card-title')
    <h3>{{ $page }}</h3>
    <p class="text-sm mb-0">
        <span class="font-weight-bold mt-2">En esta página puede ver la información del departamento de {{ $departamento->nombre }} así como de sus empleados.</span>
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
                  Departamento
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    Nombre del departamento:
                  </span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    {{ $departamento->nombre }}
                  </span>
                </td>
              </tr>
              <tr>
                <td class="text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    Localización:
                  </span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    {{ $departamento->localizacion }}
                  </span>
                </td>
              </tr>
              <tr>
                <td class="text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    Jefe de departamento:
                  </span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-xs font-weight-bold">
                    @foreach($empleados as $empleado)
                      @if($departamento->idempleadojefe == NULL)
                          {{ 'Sin jefe' }}
                      @else
                          @if($empleado->id == $departamento->idempleadojefe)
                            {{ $empleado->nombre . ' ' . $empleado->apellidos }}
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

@section('card-table')
        <br>
        <br>
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h4>Jefe del departamento de {{ $departamento->nombre }}</h4>
            </div>
          </div>
        </div>
  
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
            @if($departamento->idempleadojefe != NULL)
            <tbody>
              @foreach($empleados as $empleado)
                    @if($departamento->idempleadojefe == $empleado->id)
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
                            {{ $departamento->nombre }}
                          </span>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="text-xs font-weight-bold">
                            @if($departamento->idempleadojefe == $empleado->id)
                              {{ 'Sí es jefe' }}
                            @else
                              {{ 'No es jefe' }}
                            @endif
                          </span>
                        </td>
                      </tr>
                    @endif
              @endforeach
            </tbody>
            @endif
        </table>
    <br>
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h4>Otros empleados del departamento de {{ $departamento->nombre }}</h4>
            </div>
          </div>
        </div>
    

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
                @if($departamento->id == $empleado->iddepartamento && $departamento->idempleadojefe != $empleado->id)
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
                        {{ $departamento->nombre }}
                      </span>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="text-xs font-weight-bold">
                        @if($departamento->idempleadojefe == $empleado->id)
                          {{ 'Sí es jefe' }}
                        @else
                          {{ 'No es jefe' }}
                        @endif
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
        <a href="{{ url('departamento') }}">
            &larr; Volver
        </a>
    </div>
@endsection