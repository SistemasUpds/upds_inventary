<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte PDf</title>
</head>
<body>
<section class="section dashboard">
    <h5 class="card-title">Muebles del Area de <span>| {{ $area->nombre}}</span></h5>
        @if( count($datosFiltrados) > 0 )
        <table id="tabla-items" class="table table-borderless datatable">
            <thead>
                <tr>
                    <th scope="col">Codigó</th>
                    <th scope="col">Activo</th>
                    <th scope="col">Tipo de Activo</th>
                    <th scope="col">Fecha de compra</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fecha de baja</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Observación</th>
                </tr>
            </thead>
            @foreach($datosFiltrados as $item)
            <tbody>
                <tr>
                    <td>{{$item->codigo}}</td>
                    <td>{{$item->nombre}}</td>
                    <td>{{$item->tipo_id->nombre}}</td>
                    <td>{{ \Carbon\Carbon::parse($item->fecha_compra)->format('d/m/Y') }}</td>
                    <td>{{$item->descripcion }}</td>
                    <td>{{$item->fecha_baja}}</td>
                    @if ($item->estado == '1')
                        <td>No hay</td>
                        <td><span class="badge bg-success">Activo</span></td>
                    @else
                        <td>{{$item->fecha_baja}}</td>
                        <td><span class="badge bg-danger">Inactivo</span></td>
                    @endif
                    <td>hola</td>
                </tr>
            </tbody>
            @endforeach
        </table>
        @else
            <div class="divider"></div>
            <p class="center-align">No hay elementos para mostrar. ¡Vamos a agregar algunos!</p>
        @endif
</section>
</body>
</html>