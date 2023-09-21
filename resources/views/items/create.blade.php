@extends('layouts.app')

@section('content')

<style>
    .img{
        margin:10px auto;
        border-radius:5px;
        border: 1px solid #999;
        padding:13px;
        width:220px;
        height:220px;
        background-size: 100% 100%;
        background-repeat:no-repeat;
        background:url(../img/imagen.jpg);
        background-size: cover;
    }
    .img img{
        width: 100%;
    }
    @media all and (min-width: 500px) and (max-width: 1000px)
    {  
    .img{
        margin:20px auto;
        border-radius:5px;
        border: 1px solid #999;
        padding:13px;
        width:300px;
        height:300px;
        background-size: 100% 100%;
        background-repeat:no-repeat;
        background:url(../img/imagen.jpg);
        background-size: cover;
        }
    }
    .img img{
        width:100%;
    }
</style>

<section class="section">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title"> Registrar Nuevo Activo</h5>
                <!-- Advanced Form Elements -->
                <form id="image-form" method="post" action="{{ url('admin/item/') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Detalles del Activo</label>
                    <div class="col-sm-10">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="id_tipo" name="id_tipo" aria-label="Tipo de activo">
                            <option value="" selected disabled>Selecciona el Tipo</option>
                                @if( count($tipoActivo) > 0 )
                                    @foreach( $tipoActivo as $collection )
                                            <option value="{{$collection->id}}" data-codigo="{{ $collection->codigo }}">{{$collection->nombre}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <label for="id_area">Selecciona un Tipo</label>
                            @if ($errors->has('id_tipo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_tipo') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="nombre" name="nombre" aria-label="Tipo de activo">
                                <option value="" selected disabled>Selecciona el Activo</option>
                                <option value="ningun-activo">Ningún Activo Seleccionado</option>
                            </select>
                            <label for="nombre">Selecciona el Activo</label>
                            @if ($errors->has('nombre'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nombre') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" name="fecha" value="{{ old('fecha') }}" id="fecha" max="{{ date('Y-m-d') }}">
                            <label for="fecha">Fecha de compra</label>
                            @if ($errors->has('fecha'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fecha') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="modelo" value="{{ old('modelo') }}" id="modelo">
                                    <label for="modelo">Modelo</label>
                                    @if ($errors->has('modelo'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('modelo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="serie" value="{{ old('serie') }}" id="serie">
                                    <label for="serie">Serie</label>
                                    @if ($errors->has('serie'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('serie') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="id_estado" name="id_estado" aria-label="Esatdo del activo">
                                <option value="" selected disabled>Estado del Activo</option>
                                    @if( count($estados) > 0 )
                                        @foreach( $estados as $collection )
                                                <option value="{{$collection->id}}">{{$collection->estado}}</option>
                                        @endforeach
                                    @endif
                            </select>
                            <label for="id_estado">Estado del Activo</label>
                            @if ($errors->has('id_estado'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_estado') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-floating mb-3" id="upload-container">
                            <input type="file" name="image" class="form-control" id="uploadInput">
                        </div>
                        <input type="hidden" id="image-source" name="image_source">
                        <input type="hidden" id="image-data" name="image_data">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="id_centro" name="id_centro" aria-label="Centro de Analisis">
                            <option value="" selected disabled>Selecciona Centro de Analisis</option>
                                @if( count($analis) > 0 )
                                    @foreach( $analis as $collection )
                                            <option value="{{$collection->id}}">{{$collection->centro_analisis}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <label for="id_area">Selecciona Centro de Analisis</label>
                            @if ($errors->has('id_centro'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_centro') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="id_area" name="id_area" aria-label="Selecciona una Area">
                            <option value="{{old('id_area')}}" selected disabled>Selecciona el Area</option>
                                @if( count($areas) > 0 )
                                    @foreach( $areas as $collection )
                                        @if ( isset($idarea) )
                                            @if ($collection->id === $idarea->id)
                                                <option value="{{ old('id_area') . $collection->id}}" selected>{{$collection->nombre}}</option>    
                                            @else
                                                <option value="{{ old('id_area') . $collection->id}}">{{$collection->nombre}}</option>
                                            @endif
                                        @else
                                            <option value="{{ old('id_area') . $collection->id}}">{{$collection->nombre}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            
                            <label for="id_area">Selecciona una Area</label>
                            @if ($errors->has('id_area'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('id_area') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="descripcion" value="{{ old('descripcion') }}" placeholder="Descripción corta del mueble" id="descripcion" style="height: 100px;"></textarea>
                            <label for="descripcion">Descripcion</label>
                            @if ($errors->has('descripcion'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('descripcion') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ URL::previous() }}" type="reset" class="btn btn-secondary">Cancelar</a>
                </div>
                </form><!-- End General Form Elements -->
            </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div id="imageContainer" class="img"></div>
        </div>
    </div>
</section>

    <script>
        // Obtener referencia al elemento de entrada de archivo
		var uploadInput = document.getElementById('uploadInput');
		// Obtener referencia al contenedor de la imagen
		var imageContainer = document.getElementById('imageContainer');
		// Agregar un evento change al elemento de entrada de archivo
		uploadInput.addEventListener('change', function(event) {
			// Obtener el archivo seleccionado
			var file = event.target.files[0];
			// Crear una instancia de FileReader
			var reader = new FileReader();
			// Definir la función de carga completada
			reader.onload = function(e) {
				// Crear un elemento de imagen
				var image = document.createElement('img');
				// Establecer la ruta de la imagen como el resultado de la carga
				image.src = e.target.result;
                image.height = 200;
                image.width = 200;
				// Agregar la imagen al contenedor
				imageContainer.appendChild(image);
			}
			// Leer el archivo como una URL de datos
			reader.readAsDataURL(file);
		});
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
        var switchInput = document.getElementById('switch-input');
        var uploadContainer = document.getElementById('upload-container');
        var cameraContainer = document.getElementById('camera-container');
        var video = document.getElementById('video-preview');
        var captureBtn = document.getElementById('capture-btn');
        var imagePreview = document.getElementById('image-preview');
        var imageSource = document.getElementById('image-source');
        var imageDataInput = document.getElementById('image-data');
        var imageForm = document.getElementById('image-form');
        var mediaStream;

        switchInput.addEventListener('change', function() {
            if (switchInput.checked) {
                uploadContainer.style.display = 'none';
                cameraContainer.style.display = 'block';
                // Activar la cámara
                if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                    navigator.mediaDevices.getUserMedia({ video: true })
                        .then(function(stream) {
                            video.srcObject = stream;
                            mediaStream = stream;
                            video.addEventListener('loadedmetadata', function() {
                                // Ajustar el tamaño de la cámara al tamaño del contenedor
                                var containerWidth = video.parentElement.clientWidth;
                                var containerHeight = video.parentElement.clientHeight;

                                var videoRatio = video.videoWidth / video.videoHeight;
                                var containerRatio = containerWidth / containerHeight;

                                if (videoRatio > containerRatio) {
                                    video.style.width = containerWidth + 'px';
                                    video.style.height = (containerWidth / videoRatio) + 'px';
                                } else {
                                    video.style.width = (containerHeight * videoRatio) + 'px';
                                    video.style.height = containerHeight + 'px';
                                }
                            });
                        })
                        .catch(function(error) {
                            console.log("Se produjo un error al acceder a la cámara: ", error);
                        });
                }
            } else {
                uploadContainer.style.display = 'block';
                cameraContainer.style.display = 'none';

                // Detener la cámara
                if (mediaStream) {
                    var tracks = mediaStream.getTracks();
                    tracks.forEach(function(track) {
                        track.stop();
                    });
                }
            }
        });

        captureBtn.addEventListener('click', function() {
            var canvas = document.createElement('canvas');
            var context = canvas.getContext('2d');

            if (video.videoWidth > 0 && video.videoHeight > 0) {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;

                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                var imageData = canvas.toDataURL();
                
                imageSource.value = 'Cámara';
                imageDataInput.value = encodeURIComponent(imageData);
                
                // Mostrar la imagen capturada en la vista previa
                imagePreview.src = imageData;
                imageForm.sunmit();

            }
            
        });

        uploadInput.addEventListener('change', function() {
            // ...

            // Establecer el origen de la imagen como "Subida"
            imageSource.value = 'Subida';
            var reader = new FileReader();
            reader.onload = function(e) {
                imageDataInput.value = e.target.result;
            imageForm.submit();
            };
            reader.readAsDataURL(file);
        });

    });

    </script>
    <script>
        // Captura el evento change del select "id_tipo"
        document.getElementById('id_tipo').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var novusField = document.getElementById('novus');
    
            // Obtiene el valor del campo "codigo" de la opción seleccionada y actualiza el campo "novus"
            var codigo = selectedOption.getAttribute('data-codigo');
            novusField.value = codigo;
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#id_tipo').on('change', function () {
                var tipoId = $(this).val();
    
                // Realiza una solicitud AJAX para obtener los activos relacionados con el tipo seleccionado.
                $.ajax({
                    type: 'GET',
                    url: '/admin/obtener-activos-por-tipo/' + tipoId, // Reemplaza esta URL con la ruta correcta en tu aplicación Laravel.
                    success: function (data) {
                        $('#nombre').empty(); // Limpia el segundo select.
    
                        // Agrega las opciones de activos relacionados al tipo.
                        $.each(data, function (key, value) {
                            $('#nombre').append('<option value="' + value.id + '">' + value.activo + '</option>');
                        });
                    }
                });
            });
        });
    </script>
    
    
@endsection
