<!DOCTYPE html>
<html lang="es" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{env('APP_NAME')}}</title>

    <meta name="description" content="" />
    <!-- Favicon -->
    {{-- <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" /> --}}
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('template/vendor/fonts/boxicons.css')}}" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('template/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('template/vendor/css/theme-default.css')}}"  class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('template/css/demo.css')}}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('template/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('template/vendor/js/helpers.js')}}"></script>
</head>

<body>
    <!-- Content -->
    <h4 class="fw-bold p-4">Blank Page</h4>
    <script src="{{asset('template/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('template/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('template/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('template/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('template/vendor/js/menu.js')}}"></script>
    <!-- Main JS -->
    <script src="{{asset('template/js/main.js')}}"></script>
</body>

</html>
