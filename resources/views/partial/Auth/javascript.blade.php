{{ Html::script('plugins/jquery/jquery.min.js') }}
{{ Html::script('plugins/bootstrap/js/bootstrap.bundle.min.js') }}
{{ Html::script('plugins/sweetalert2/sweetalert2.all.min.js') }}
{{ Html::script('plugins/select2/js/select2.min.js') }}
{{ Html::script('main/js/datatables.min.js') }}
{{ Html::script('adminlte/js/adminlte.min.js') }}
{{ Html::script('main/js/jquery.fancybox.min.js') }}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
$('document').ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').popover();
    $('.pop').popover('toggle');
    setTimeout(function(){
        $('.pop').popover('hide');
    }, 2200);
});
</script>
@yield('script')
