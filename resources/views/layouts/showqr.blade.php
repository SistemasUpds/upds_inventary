<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Upds</title>

    <!-- Favicons -->
    <link href="{{ asset('img/logo.png')}}" rel="icon">
    <link href="{{ asset('img/logo.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
</head>
<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center" style="background-color: blue">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="{{ asset('img/logo.png')}}" alt="">
                <span class="d-none d-lg-block">UNIVERSIDAD PRIVADA DOMINGO SAVIO</span>
            </a>
        </div><!-- End Logo -->
    </header><!-- End Header -->
    <main id="main" class="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <section class="section">
                        <div class="card">
                            <div class="card-header" style="text-align: center"><b>Activo: </b>{{$item->activo->activo}}</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ asset('img/fotos/'.$item->image) }}" alt="Foto" width="350" height="300">
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="card-title">Area: {{$item->area->nombre}}</h5>
                                        <h6><b>Tipo de Activo:</b> {{$item->tipo->nombre}}</h6>
                                        <h6><b>Encargado:</b> {{$item->area->encargado}}</h6>
                                        <p><b>{{$item->codigo}}</b></p>
                                        <h6><b>Fecha compra:</b> {{$item->fecha_compra}}</h6>
                                        <h6><b>Estado:</b> {{$item->Estado->estado}}</h6>
                                        <h6><b>Centro Analisis:</b> {{$item->centro->centro_analisis}}</h6>
                                        <p>{{$item->descripcion}}</p>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <!-- End Card with header and footer -->
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>
</html>
