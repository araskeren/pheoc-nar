<!doctype html>
<html lang="en">
<head>
    @include('partial.head')
    <style>
        body {
            background-image: url("{{ url('img/covid-wallpaper.jpg') }}") !important;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/') }}"><b><img src="{{ url('img/coronavirus.png') }}" style="width:40px;" /> <strong>COVID-19</strong></b>
        </a>
        <small>Jawa Tengah</small>
    </div>
    <div class="card" style="border-radius: 12px;">
        <div class="card-body login-card-body" style="border-radius: 12px;">
            <span style="opacity: 0.5;"><i class="fa fa-lock" style="color:#4fb61f;"></i> <i>Secure Sign-In</i></span>
            <center><img src="{{ url('img/loadingJateng.gif') }}" style="width:80px;" /></center>
            <br />
            <form id="login">
                {{-- <p class="login-box-msg"><i class="fa fa-lock" style="color:#4fb61f"></i> Secure Sign-In</p> --}}
                <div class="input-group mb-3 mt-2">
                    <input id="username" type="text" class="form-control form-control-lg" name="username" placeholder="Username" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control form-control-lg pwd" name="password" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text" id="show-password" style="background-color:#eaeaea; cursor: pointer;">
                            <i class="fa fa-eye icon-lg" title="show password"></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5" style="padding-top: 5px;">
                        <span id="captcha">{!! captcha_img('mini') !!}</span>
                        <a href="javascript:;" id="reload-captcha" style="margin-top: -4px;" class="btn btn-default btn-sm" title="reload"><i class="fa fa-refresh"></i></a>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="captcha-input" name="captcha" style="width:170px;" placeholder="input kode keamanan" />
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block btn-lg btn-submit"><i class="fa fa-sign-in-alt"></i> &nbsp;Sign In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{ Html::script('plugins/jquery/jquery.min.js') }}
{{ Html::script('plugins/bootstrap/js/bootstrap.bundle.min.js') }}
{{ Html::script('adminlte/js/adminlte.min.js') }}
{{ Html::script('main/js/iziToast.min.js') }}
{{ Html::script('main/js/function.js') }}
<script>
    $('document').ready(function(){

        $('#show-password').on('click', function(){
            if ($('.pwd').attr('type')=='password') {
                $(this).html(`<i class="fa fa-eye-slash icon-lg" title="show password"></i>`)
                $('.pwd').attr('type', 'text')
            } else {
                $(this).html(`<i class="fa fa-eye icon-lg" title="show password"></i>`)
                $('.pwd').attr('type', 'password')
            }
        })

        $('#captcha img').css({'margin-top':'-2px'})

        let refresh_captcha = () => {
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
            $.ajax({
                url: `{{ route('refresh_captcha') }}`,
                type: 'POST',
                dataType: "JSON",
                timeout: 10000,
                data: {
                    _token: CSRF_TOKEN,
                },
                beforeSend: function () {

                },
                success: function (data) {
                    $('#captcha').html(data.captcha)
                }, error: function (x, t, m) {
                    $('.btn-submit').attr('disabled', false)
                }
            })
        }
        $('#reload-captcha').on('click', function(e){
            e.preventDefault()
            refresh_captcha()
            $('#captcha img').css({'margin-top':'-2px'})
        })

        $('#login').submit(function(e){
            e.preventDefault()
            $('.btn-submit').attr('disabled', true)
            let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
            let username = $('#username').val()
            let password = $('#password').val()
            let captcha = $('#captcha-input').val()
            // let recaptcha = $('#g-recaptcha-response').val()
            $.ajax({
                url: `${baseUrl()}/login-action`,
                type: 'POST',
                dataType: "JSON",
                timeout: 10000,
                data: {
                    _token: CSRF_TOKEN,
                    username: username,
                    password: password,
                    captcha: captcha
                },
                beforeSend: function () {

                },
                success: function (data) {
                    if (data.status=='success') {
                        iziToast.success({
                            title: 'Success,',
                            position: 'bottomRight',
                            message: data.msg,
                            timeout: 2000
                        })
                        setTimeout(function(){
                            window.location.href = baseUrl() + '/dashboard';
                        }, 1500)
                    } else {
                        refresh_captcha()
                        iziToast.error({
                            title: 'Ops,',
                            position: 'bottomRight',
                            message: data.msg,
                            timeout: 2000
                        })
                        $('.btn-submit').attr('disabled', false)
                    }
                }, error: function (x, t, m) {
                    refresh_captcha()
                    $('.btn-submit').attr('disabled', false)
                }
            })
        })
    })
</script>
</body>
</html>
