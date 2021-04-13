<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="icon" type="image/png" href="{{ url('img/favicon.png') }}">
{{Html::style('plugins/fontawesome-free/css/all.min.css')}}
{{Html::style('plugins/fontawesome-free/css/v4-shims.min.css')}}
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
{{Html::style('adminlte/css/adminlte.min.css')}}
{{Html::style('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}
{{Html::style('main/css/iziToast.min.css')}}
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
@yield('stylesheet')
<title>COVID-19</title>