<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>@yield('title')</title>
{{Html::style('plugins/fontawesome-free/css/all.min.css')}}
{{Html::style('adminlte/css/adminlte.min.css')}}
{{Html::style('main/css/jquery.fancybox.min.css')}}
{{Html::style('plugins/sweetalert2/sweetalert2.min.css')}}
{{Html::style('plugins/select2/css/select2.min.css')}}
{{Html::style('main/css/datatables.min.css')}}
{{Html::style('main/css/style.css')}}
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<style>
    .swal2-container {
        z-index: 999999;
    }
</style>
@yield('stylesheet')
