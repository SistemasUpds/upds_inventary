@extends('layouts.app')

@section('content')

<style>
    @media screen and (max-width: 767px) {
        .scrollable-table {
            overflow: auto;
            -webkit-overflow-scrolling: touch;
        }
    }
</style>

@if ($area->encargado === null)
    <div class=" alert alert-danger alert-dismissible fade show">
        <span class="alert-text text-black">Porfavor agregar al encargado del area</span> <a href="{{ url('admin/area/'.$area->id.'/edit')}}">Ir a</a>
    </div>
@endif

<section class="section">
    <div class="col-lg-6" style="margin: 0 auto;">
        <!-- Card with header and footer -->
        <div class="card">
            <div class="card-header" style="text-align: center">{{$area->nombre}}</div>
            <div class="card-body">
                <h5 class="card-title">{{$area->encargado}}</h5>
                {{$area->descripcion}}
            </div>
            <br>
            <div style="display: flex; justify-content: center; align-items: center;">
                <a class="btn btn-outline-dark" href="{{ isset($area->id) ? url('admin/item/create/'.$area->id) : url('admin/item/create/'.'0') }}">
                    <i class="bi bi-collection"> Agregar Activo</i>
                </a>
                <a class="btn btn-outline-dark" href="{{ url('admin/material/create/'.$area->id) }}" style="margin-left: 20px;">
                    <i class="bi bi-collection"> Otro Material</i>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="section dashboard">
    <div class="card">
        <div class="card-body">
            <div class="filter">
                <form action="{{ url('admin/generar-pdf') }}" method="GET">
                    {{ csrf_field() }}
                    <input type="hidden" name="area" value="{{$area->id}}">
                    <div class="input-group mb-2">
                        <select class="form-control" id="categoria-filtro" name="id_tipo" aria-label="Tipo de activo">
                            <option value="" selected disabled>Selecciona el Tipo</option>
                            @if( count($tipo) > 0 )
                                <option value="00">Todo...</option>
                                    @foreach( $tipo as $collection )
                                        <option value="{{ $collection->id }}">{{ $collection->nombre }}</option>
                                    @endforeach
                            @endif
                        </select>
                        @if ($user->permiso->exportar == 1)
                            <span class="input-group-text">
                                <input class="btn btn-light" type="submit" value="Exportar">
                            </span>
                        @endif
                    </div>
                </form>
            </div>
        <h5 class="card-title">Activos del Area <span>| {{$area->nombre}}</span></h5>
          <!-- Bordered Tabs -->
          <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Activos</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Otro Material</button>
            </li>
          </ul>

          <button id="export">Export Now</button>

          <div class="tab-content pt-2 scrollable-table" id="borderedTabContent">
            <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                @if( count($area->items) > 0 )
                    <table class="table table-borderless datatable" id="tableData" border="1" cellpadding="5" cellspacing="0">
                        <!--id="tabla-items" -->
                        <thead>
                            <tr>
                                <th scope="col">Código</th>
                                <th scope="col">Activo</th>
                                <th scope="col">Tipo de Activo</th>
                                <th scope="col">Fecha de compra</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Estado</th>
                                <th scope="col">De baja</th>
                                <th scope="col">Ver</th>
                                <th scope="col">Historial</th>
                            </tr>
                        </thead>
                        @foreach($area->items as $item)
                            <tbody>
                                <tr>
                                    <th scope="row">{{$item->codigo}}</th>
                                    <td>{{$item->activo->activo}}</td>
                                    <td style="display: none">{{$item->tipo_id}}</td>
                                    <td>{{$item->tipo->nombre}}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->fecha_compra)->format('d/m/Y') }}</td>
                                    <td>{{ strlen($item->descripcion) > 25 ? substr($item->descripcion, 0, 25) . '...' : $item->descripcion }}</td>
                                    <td>{{ $item->Estado->estado }}</td>
                                    @if ($item->estado == '1')
                                        <td><a type="button" data-toggle="{{$user->permiso->dar_baja_item == 0 ? '' : 'modal'}}" data-target="#modal-familiar"><span class="badge bg-success">Activo</span></a></td>
                                        @include('areas.modal')
                                    @else
                                        <td><span class="badge bg-danger">Inactivo</span></td>
                                    @endif
                                    <td><a href="{{ url('admin/item/'.$item->id.'/show') }}"><i class="fa fa-eye"></i></a></td>
                                    <td><a href="{{ url('admin/item/'.$item->id.'/history') }}"><i class="fa fa-history"></i></a></td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                @else
                    <div class="divider"></div>
                    <p class="center-align">No hay elementos para mostrar. ¡Vamos a agregar algunos!</p>
                @endif
            </div>
            <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                @if( $cantidad > 0 )
                    <table id="tabla-items" class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Ver</th>
                                <th scope="col">Editar</th>
                            </tr>
                        </thead>
                        @foreach($otro as $item)
                            <tbody>
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td scope="row">{{$item->nombre}}</td>
                                    <td style="display: none">{{$item->area_id}}</td>
                                    <td>{{ strlen($item->descripcion) > 25 ? substr($item->descripcion, 0, 25) . '...' : $item->descripcion }}</td>
                                    <td><a href="{{ url('admin/otro/material'.$item->id.'/show') }}"><i class="fa fa-eye"></i></a></td>
                                    <td><a href="{{ url('admin/otro/material'.$item->id.'/edit') }}"><i class="fa fa-edit"></i></a></td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    <a href="{{ url('admin/otro/material/descargar'.$area->id) }}">Descargar</a>
                @else
                    <div class="divider"></div>
                    <p class="center-align">No hay elementos para mostrar.</p>
                @endif
            </div>
          </div><!-- End Bordered Tabs -->
        </div>
      </div>
    <!-- End Recent Sales -->
    <a class="badge bg-primary" href="{{url('/')}}"><i class="fa fa-check"></i> Volver</a>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>

<script>
    document.getElementById('categoria-filtro').addEventListener('change', function () {
        filtrarTabla();
    });
    function filtrarTabla() {
        var categoriaSeleccionada = document.getElementById('categoria-filtro').value;
        var tablaItems = document.getElementById('tabla-items');
        var filas = tablaItems.getElementsByTagName('tr');
        for (var i = 1; i < filas.length; i++) { // Comienza en 1 para omitir la fila de encabezado
            var categoriaItem = filas[i].getElementsByTagName('td')[1].textContent; // Cambiar el índice a la columna de categoría (tipo_id)
            console.log(categoriaItem);
            if ( categoriaSeleccionada === '' || categoriaSeleccionada === '00' || categoriaSeleccionada === categoriaItem ) {
                filas[i].style.display = ''; // Mostrar la fila si la categoría coincide o no se ha seleccionado ninguna categoría
            } else {
                filas[i].style.display = 'none'; // Ocultar la fila si la categoría no coincide
            }
        }
    }
</script>
<script>
    document.getElementById('export').onclick = function () {
    var tableId = document.getElementById('tableData').id;
    htmlTableToExcel(tableId, '');
}

var htmlTableToExcel = function (tableId, fileName = '') {

    var excelFileName = 'datos_de_tabla_excel';
    var TableDataType = 'application/vnd.ms-excel';
    var selectTable = document.getElementById(tableId);
    var htmlTable = encodeURIComponent(selectTable.outerHTML); // Codificar la tabla

    fileName = fileName ? fileName + '.xls' : excelFileName + '.xls';
    var excelFileURL = document.createElement("a");
    document.body.appendChild(excelFileURL);

    if (navigator.msSaveOrOpenBlob) {
        var blob = new Blob(['\ufeff', htmlTable], {
            type: TableDataType
        });
        navigator.msSaveOrOpenBlob(blob, fileName);
    } else {

        excelFileURL.href = 'data:' + TableDataType + ', ' + htmlTable;
        excelFileURL.download = fileName;
        excelFileURL.click();
    }
}

</script>
@endsection
