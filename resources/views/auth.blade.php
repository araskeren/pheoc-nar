<!DOCTYPE html>
<html lang="en">
<head>
    @include('partial.Auth.head')
</head>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        @include('partial.Auth.navbar')
        @yield('content')
        @include('partial.Auth.sidebar')
        @include('partial.Auth.footer')
    </div>
    @include('partial.Auth.javascript')
</body>
</html>
