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
                <h6 class="card-title"> Registrar Otro Material</h6>
                <!-- Advanced Form Elements -->
                <form id="image-form" method="post" action="{{ url('admin/material/create') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Detalles del Material</label>
                    <div class="col-sm-10">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" id="nombre">
                            <label for="nombre">Nombre del Material</label>
                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-floating mb-3" id="upload-container">
                            <input type="file" name="image" class="form-control" id="uploadInput">
                        </div>
                        <input type="hidden" id="image-source" name="image_source">
                        <input type="hidden" id="image-data" name="image_data">
                        
                        <input type="hidden" id="image-source" name="id_area" value="{{$area->id}}">
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
    
@endsection
