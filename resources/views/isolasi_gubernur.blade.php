@extends('auth')
@section('title', ucfirst(Request::segment(1)).Request::segment(2) ? ucfirst(Request::segment(1)) : " - ".ucfirst(Request::segment(1)))
@section('content')
<style type="text/css">
	.shown + tr {
        background-color: #FAFAFA;
    }
</style>
<div class="content-wrapper" style="min-height: 359px;">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> Selamat datang <small><br />di Sistem Administrasi <strong>Covid-19</strong> Jawa Tengah</small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="card mt-md-3">
                <div class="card-header">
                    <h5 class="card-title font-weight-bold">Daftar Ketersediaan Ruang Rumah Sakit</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table-ketersediaan">
                            <thead>
                                <th>#</th>
                                <th>Nama Rumah Sakit</th>
                                <th>Kabupaten / Kota</th>
                                <th>R. Isolasi Tersedia</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($hospital_room as $ruang)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ruang->nama }}</td>
                                    <td>{{$ruang->kabkot}}</td>
                                    <td>
                                        {{ 
                                            $ruang->tt_ventilator_tekanan_negatif +
                                            $ruang->tt_non_ventilator_tekanan_negatif +
                                            $ruang->tt_ventilator_non_tekanan_negatif +
                                            $ruang->tt_non_ventilator_non_tekanan_negatif
                                        }}
                                    </td>
                                    <td>
                                        <button 
                                            class="btn btn-sm btn-primary tombol-detail float-right"
                                            value="{{ json_encode([
                                                'tt_ventilator_tekanan_negatif' => $ruang->tt_ventilator_tekanan_negatif,
                                                'tt_non_ventilator_tekanan_negatif' => $ruang->tt_non_ventilator_tekanan_negatif,
                                                'tt_ventilator_non_tekanan_negatif' => $ruang->tt_ventilator_non_tekanan_negatif,
                                                'tt_non_ventilator_non_tekanan_negatif' => $ruang->tt_non_ventilator_non_tekanan_negatif
                                            ]) }}"
                                        >Detail <i class="fa fa-chevron-down"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script type="text/javascript">
	$('document').ready(function(){
        // table ketersedian
        let table1 = $('#table-ketersediaan').DataTable();

        function format(data) {
        return  "<table class='table mt-md-0'>"+
                "<tr>"+
                    "<td width='9%'></td>"+
                    "<td width='50%'>TT Ventilator (Bertekanan Negatif)</td>"+
                    "<td>"+ data.tt_ventilator_tekanan_negatif +"</td>"+
                "</tr>"+
                "<tr>"+
                    "<td></td>"+
                    "<td>TT Non Ventilator (Bertekanan Negatif)</td>"+
                    "<td>"+ data.tt_non_ventilator_tekanan_negatif +"</td>"+
                "</tr>"+
                "<tr>"+
                    "<td></td>"+
                    "<td>TT Ventilator (Belum Bertekanan Negatif)</td>"+
                    "<td>"+ data.tt_ventilator_non_tekanan_negatif +"</td>"+
                "</tr>"+
                "<tr>"+
                    "<td></td>"+
                    "<td>TT Non Ventilator (Belum Bertekanan Negatif)</td>"+
                    "<td>"+ data.tt_non_ventilator_non_tekanan_negatif +"</td>"+
                "</tr>"+
            "</table>"
        }

        // Add event listener for opening and closing details
        $('#table-ketersediaan tbody').on('click', 'td button.tombol-detail', function () {
            let valueData = JSON.parse($(this).val());
            // console.log(valueData)
            var tr = $(this).closest('tr');
            var row = table1.row( tr );

            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child(format(valueData)).show();
                tr.addClass('shown');
            }
            // toggle button
            $(this).toggleClass('btn-outline-primary btn-primary')
            $(this).find('i').toggleClass('fa-chevron-up fa-chevron-down')
        } );
    })
</script>
@endsection