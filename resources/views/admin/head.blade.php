<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />

<title>{{ $title }}</title>
<link rel="icon" type="image/png" href="/template/admin/dist/img/AdminLTELogo.png"/>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="/template/admin/plugins/fontawesome-free/css/all.min.css">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="/template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="/template/admin/dist/css/adminlte.min.css">
<link rel="stylesheet" href="/template/admin/dist/css/togglebutton.css">


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


@yield('head')