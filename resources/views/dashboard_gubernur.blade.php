@extends('auth')
@section('title', ucfirst(Request::segment(1)).Request::segment(2) ? ucfirst(Request::segment(1)) : " - ".ucfirst(Request::segment(1)))
@section('content')
<style type="text/css">
	.shown + tr {
        background-color: azure
    }
    .nav-tabs .nav-link.active {
        color: #D62522;
        font-weight: bold
    }
    .tab-content>.tab-pane {
        display: block;
        height: 0;
        overflow: hidden;
    }
    .tab-content>.tab-pane.active {
        height: auto;
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
        {{-- Dashboard Rekap jumlah ODP PDP Posotif --}}
        
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="p-3">
                        <div class="h5" style="font-weight: 600;">Data Real Time Kasus COVID-19 di Jawa Tengah</div>
                            <div>Update Terakhir : {{ date('d M Y H:i') }} WIB</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="card border border-primary">
                                        <div class="pt-md-3" style="background-color: #ECDDFE;">
                                            <div class="text-center h4"><b>ODP</b></div>
                                            <div class="text-center font-weight-normal" style="color: #8E2DDB; font-size: 42px">
                                                <b>{{ number_format($summary->accu_odp_berjalan + $summary->accu_odp_selesai, 0, ',', '.') }}</b>
                                            </div>
                                            <div class="text-center pb-md-2 font-weight-normal">Total kasus</div>
                                        </div>
                                        <div>
                                            <div class="text-center pt-md-2">Dalam Pemantauan</div>
                                            <div style="color: #8E2DDB;" class="text-center font-weight-bold h3" id="odp_proses">{{ number_format($summary->accu_odp_berjalan, 0, ',', '.') }}</div>
                                            <hr class="my-md-0">
                                            <div class="text-center pt-md-2">Selesai Pemantauan</div>
                                            <div style="color: #8E2DDB;" class="text-center font-weight-bold h3" id="odp_selesai">{{ number_format($summary->accu_odp_selesai, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="card border border-warning">
                                        <div class="pt-md-3" style="background-color: #FFEFD8;;">
                                            <div class="text-center h4"><b>PDP</b></div>
                                            <div class="text-center font-weight-normal" style="color: #FFA51F; font-size: 42px">
                                                <b>{{ number_format($summary->accu_pdp_dirawat + $summary->accu_pdp_sembuh + $summary->accu_pdp_meninggal, 0, ',', '.') }}</b>
                                            </div>
                                            <div class="text-center pb-md-2 font-weight-normal">Total kasus</div>
                                        </div>
                                        <div>
                                            <div class="text-center pt-md-2">Pasien Dirawat</div>
                                            <div style="color: #FFA51F;" class="text-center font-weight-bold h3" id="pdp_dirawat">{{ number_format($summary->accu_pdp_dirawat, 0, ',', '.') }}</div>
                                            <hr class="my-md-0">
                                            <div  class="text-center pt-md-2">Pasien Sembuh</div>
                                            <div style="color: #FFA51F;" class="text-center font-weight-bold h3" id="pdp_pulang_sehat">{{ number_format($summary->accu_pdp_sembuh, 0, ',', '.') }}</div>
                                            <hr class="my-md-0">
                                            <div class="text-center pt-md-2">Pasien Meninggal</div>
                                            <div style="color: #FFA51F;" class="text-center font-weight-bold h3" id="pdp_meninggal">{{ number_format($summary->accu_pdp_meninggal, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="card border border-danger">
                                        <div class="pt-md-3" style="background-color: #FADFDF;">
                                            <div class="text-center h4"><b>Positif</b> </div>
                                            <div class="text-center font-weight-normal" style="color: #D62522; font-size: 42px">
                                                <b>{{ number_format($summary->accu_covid_dirawat + $summary->accu_covid_sembuh + $summary->accu_covid_meninggal, 0, ',', '.') }}</b>
                                            </div>
                                            <div class="text-center pb-md-2 font-weight-normal">Total kasus</div>
                                        </div>
                                        <div>
                                            <div class="text-center pt-md-2">Pasien Dirawat</div>
                                            <div style="color: #D62522;" class="text-center font-weight-bold h3" id="covid_dirawat">{{ number_format($summary->accu_covid_dirawat, 0, ',', '.') }}</div>
                                            <hr class="my-md-0">
                                            <div class="text-center pt-md-2">Pasien Sembuh</div>
                                            <div style="color: #D62522;" class="text-center font-weight-bold h3" id="covid_sembuh">{{number_format($summary->accu_covid_sembuh, 0, ',', '.') }}</div>
                                            <hr class="my-md-0">
                                            <div class="text-center pt-md-2">Pasien Meninggal</div>
                                            <div style="color: #D62522;" class="text-center font-weight-bold h3" id="covid_meninggal">{{ number_format($summary->accu_covid_meninggal, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card">
                        <div class="p-3">
                            <div class="h5" style="font-weight: 600;">Data Kasus COVID-19 di Jawa Tengah oleh DINKES</div>
                            <div>Update Terakhir : {{ date('d M Y H:i') }} WIB</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    <div class="card border border-primary">
                                        <div class="pt-md-3" style="background-color: #ECDDFE;">
                                            <div class="text-center h4"><b>ODP</b></div>
                                            <div class="text-center font-weight-normal" style="color: #8E2DDB; font-size: 42px">
                                                <b>
                                                    {{ number_format($summary2->odp_proses + (is_numeric($summary2->odp_selesai) ? $summary2->odp_selesai : 0) , 0, ',', '.')}}
                                                </b>
                                            </div>
                                            <div class="text-center pb-md-2 font-weight-normal">Total kasus</div>
                                        </div>
                                        <div>
                                            <div class="text-center pt-md-2">Dalam Pemantauan</div>
                                            <div style="color: #8E2DDB;" class="text-center font-weight-bold h3" id="odp_proses">{{  number_format($summary2->odp_proses, 0, ',', '.') }}</div>
                                            <hr class="my-md-0">
                                            <div class="text-center pt-md-2">Selesai Pemantauan</div>
                                            <div style="color: #8E2DDB;" class="text-center font-weight-bold h3" id="odp_selesai">{{ $summary2->odp_selesai }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="card border border-warning">
                                        <div class="pt-md-3" style="background-color: #FFEFD8;;">
                                            <div class="text-center h4"><b>PDP</b></div>
                                            <div class="text-center font-weight-normal" style="color: #FFA51F; font-size: 42px">
                                                <b>{{ number_format($summary2->pdp_dirawat + (is_numeric($summary2->pdp_pulang_sehat) ? $summary2->pdp_pulang_sehat : 0) + (is_numeric($summary2->pdp_meninggal) ? $summary2->pdp_meninggal : 0) , 0, ',', '.')}}</b>
                                            </div>
                                            <div class="text-center pb-md-2 font-weight-normal">Total kasus</div>
                                        </div>
                                        <div>
                                            <div class="text-center pt-md-2">Dirawat</div>
                                            <div style="color: #FFA51F;" class="text-center font-weight-bold h3" id="pdp_dirawat">{{ number_format($summary2->pdp_dirawat, 0, ',', '.') }}</div>
                                            <hr class="my-md-0">
                                            <div  class="text-center pt-md-2">Sembuh</div>
                                            <div style="color: #FFA51F;" class="text-center font-weight-bold h3" id="pdp_pulang_sehat">{{ $summary2->pdp_pulang_sehat }}</div>
                                            <hr class="my-md-0">
                                            <div class="text-center pt-md-2">Meninggal</div>
                                            <div style="color: #FFA51F;" class="text-center font-weight-bold h3" id="pdp_meninggal">{{ $summary2->pdp_meninggal }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="card border border-danger">
                                        <div class="pt-md-3" style="background-color: #FADFDF;">
                                            <div class="text-center h4"><b>Positif</b> </div>
                                            <div class="text-center font-weight-normal" style="color: #D62522; font-size: 42px">
                                                <b>{{ number_format($summary2->covid_dirawat + (is_numeric($summary2->covid_sembuh) ? $summary2->covid_sembuh : 0) + $summary2->covid_meninggal, 0, ',', '.') }}</b>
                                            </div>
                                            <div class="text-center pb-md-2 font-weight-normal">Total kasus</div>
                                        </div>
                                        <div>
                                            <div class="text-center pt-md-2">Dirawat</div>
                                            <div style="color: #D62522;" class="text-center font-weight-bold h3" id="covid_dirawat">{{ number_format($summary2->covid_dirawat, 0, ',', '.') }}</div>
                                            <hr class="my-md-0">
                                            <div class="text-center pt-md-2">Sembuh</div>
                                            <div style="color: #D62522;" class="text-center font-weight-bold h3" id="covid_sembuh">{{ number_format($summary2->covid_sembuh, 0, ',', '.') }}</div>
                                            <hr class="my-md-0">
                                            <div class="text-center pt-md-2">Meninggal</div>
                                            <div style="color: #D62522;" class="text-center font-weight-bold h3" id="covid_meninggal">{{ number_format($summary2->covid_meninggal, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- grafik odp pdp covi --}}
            <div class="card mt-md-3">
                <div class="card-header">
                    <h5 class="card-title font-weight-bold">Grafik Pertumbuhan COVID-19 Harian di Jawa Tengah  </h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                          <a class="nav-link active" data-toggle="tab" href="#all">Semua data</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#odp">ODP</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#pdp">PDP</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#covid">Positif</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="all" class="tab-pane active">
                          <div id="grafik-all" style="height: 400px;" class="pt-md-2"></div>
                        </div>
                        <div id="odp" class="tab-pane fade">
                          <div id="grafik-odp" style="height: 400px;" class="pt-md-2"></div>
                        </div>
                        <div id="pdp" class="tab-pane fade">
                            <div id="grafik-pdp" style="height: 400px;" class="pt-md-2"></div>
                        </div>
                        <div id="covid" class="tab-pane fade">
                            <div id="grafik-covid" style="height: 400px;" class="pt-md-2"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    
                    <svg class="mr-sm-1" width="27" height="14" viewBox="0 0 27 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.5 7C20.5 10.866 17.366 14 13.5 14C9.63401 14 6.5 10.866 6.5 7C6.5 3.13401 9.63401 0 13.5 0C17.366 0 20.5 3.13401 20.5 7Z" fill="#8E2DDB"/>
                        <rect x="0.5" y="6" width="26" height="2" rx="1" fill="#8E2DDB"/>
                    </svg> ODP (Orang Dalam pemantauan)

                    <svg class="mr-sm-1" width="27" height="14" viewBox="0 0 27 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.5 7C20.5 10.866 17.366 14 13.5 14C9.63401 14 6.5 10.866 6.5 7C6.5 3.13401 9.63401 0 13.5 0C17.366 0 20.5 3.13401 20.5 7Z" fill="#FFA51F"/>
                        <rect x="0.5" y="6" width="26" height="2" rx="1" fill="#FFA51F"/>
                    </svg> PDP (Pasien Dalam Pengawasan)
                        
                    <svg width="27" height="14" viewBox="0 0 27 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.5 7C20.5 10.866 17.366 14 13.5 14C9.63401 14 6.5 10.866 6.5 7C6.5 3.13401 9.63401 0 13.5 0C17.366 0 20.5 3.13401 20.5 7Z" fill="#D62522"/>
                        <rect x="0.5" y="6" width="26" height="2" rx="1" fill="#D62522"/>
                    </svg> Positif
                        
                </div>
            </div>
            {{-- grafik jumlah kasus per kab/kota --}}
            <div class="card mt-md-3">
                <div class="card-header">
                    <h5 class="card-title font-weight-bold">Grafik Pertumbuhan Jumlah Kasus COVID-19 per waktu di Jawa Tengah</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                          <a class="nav-link active" data-toggle="tab" href="#kabkot-odp">ODP</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#kabkot-pdp">PDP</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#kabkot-covid">Positif</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="kabkot-odp" class="tab-pane active">
                          <div id="grafik-kabkot-odp" style="height: 420px"></div>
                        </div>
                        <div id="kabkot-pdp" class="tab-pane fade">
                            <div id="grafik-kabkot-pdp" style="height: 420px"></div>
                        </div>
                        <div id="kabkot-covid" class="tab-pane fade">
                            <div id="grafik-kabkot-covid" style="height: 420px"></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
            {{-- Peta sebaran ODP PDP COvid --}}
            <div class="card mt-md-3">
                <div class="card-header">
                    <h5 class="card-title font-weight-bold">Peta Daerah Rawan COVID-19 Jawa Tengah</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                          <a class="nav-link active" data-toggle="tab" href="#persebaran-desa">Domisili/ Kelurahan</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#persebaran-kecamatan">Kecamatan</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#persebaran-kabkota">Kabupaten/ Kota</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div  id="persebaran-desa" class="tab-pane active">
                            <div class="pt-md-2">
                                <div class='tableauPlaceholder' id='viz1586007500342' style='position: relative'><noscript><a href='#'><img alt=' ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;pe&#47;persebaran-area-covid19&#47;covid19-kelurahan-desa&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='persebaran-area-covid19&#47;covid19-kelurahan-desa' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;pe&#47;persebaran-area-covid19&#47;covid19-kelurahan-desa&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1586007500342');                    var vizElement = divElement.getElementsByTagName('object')[0];                    if ( divElement.offsetWidth > 800 ) { vizElement.style.width='1000px';vizElement.style.height='827px';} else if ( divElement.offsetWidth > 500 ) { vizElement.style.width='1000px';vizElement.style.height='827px';} else { vizElement.style.width='100%';vizElement.style.height='427px';}                     var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
                            </div>
                        </div>
                        <div id="persebaran-kecamatan" class="tab-pane fade">
                            <div class="pt-md-2">
                                <div class='tableauPlaceholder' id='viz1586007094887' style='position: relative'><noscript><a href='#'><img alt=' ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;pe&#47;persebaran-area-covid-kec&#47;map-kecamatan&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='persebaran-area-covid-kec&#47;map-kecamatan' /><param name='tabs' value='no' /><param name='toolbar' value='yes' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;pe&#47;persebaran-area-covid-kec&#47;map-kecamatan&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1586007094887');                    var vizElement = divElement.getElementsByTagName('object')[0];                    vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';                    var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
                            </div>
                        </div>
                        <div id="persebaran-kabkota" class="tab-pane fade">
                            <div class="pt-md-2">
                                <div class='tableauPlaceholder' id='viz1586007415690' style='position: relative'><noscript><a href='#'><img alt=' ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;pe&#47;persebaran-area-covid-kabupaten-kotoa&#47;map-kabupaten&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='persebaran-area-covid-kabupaten-kotoa&#47;map-kabupaten' /><param name='tabs' value='no' /><param name='toolbar' value='no' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;pe&#47;persebaran-area-covid-kabupaten-kotoa&#47;map-kabupaten&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1586007415690');                    var vizElement = divElement.getElementsByTagName('object')[0];                    vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';                    var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <svg class="mr-sm-1" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="7" cy="7" r="7" fill="#63F3A0"/>
                    </svg> Area Aman
                    
                    <svg class="mr-sm-1" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="7" cy="7" r="7" fill="#FDF28F"/>
                    </svg> Terdapat ODP & PDP

                    <svg class="mr-sm-1" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="7" cy="7" r="7" fill="#FC6562"/>
                    </svg> Terdapat COVID-19
                </div>
            </div>

            {{-- Peta sebaran dot --}}
            <div class="card mt-md-3">
                <div class="card-header">
                    <h5 class="card-title font-weight-bold">Peta Sebaran Kasus COVID-19 Jawa Tengah</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                          <a class="nav-link active" data-toggle="tab" href="#persebaran-desa-dot">Domisili/ Kelurahan</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" data-toggle="tab" href="#persebaran-kecamatan-dot">Rumah Sakit</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div  id="persebaran-desa-dot" class="tab-pane active">
                            <div class="pt-md-2">
                                <div class='tableauPlaceholder' id='viz1586059255126' style='position: relative'><noscript><a href='http:&#47;&#47;corona.jatengprov.go.id'><img alt=' ' src='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Pe&#47;PersebaranCOVID-19JawaTengahPerPerson&#47;covid-19-jateng-cases&#47;1_rss.png' style='border: none' /></a></noscript><object class='tableauViz'  style='display:none;'><param name='host_url' value='https%3A%2F%2Fpublic.tableau.com%2F' /> <param name='embed_code_version' value='3' /> <param name='site_root' value='' /><param name='name' value='PersebaranCOVID-19JawaTengahPerPerson&#47;covid-19-jateng-cases' /><param name='tabs' value='no' /><param name='toolbar' value='no' /><param name='static_image' value='https:&#47;&#47;public.tableau.com&#47;static&#47;images&#47;Pe&#47;PersebaranCOVID-19JawaTengahPerPerson&#47;covid-19-jateng-cases&#47;1.png' /> <param name='animate_transition' value='yes' /><param name='display_static_image' value='yes' /><param name='display_spinner' value='yes' /><param name='display_overlay' value='yes' /><param name='display_count' value='yes' /></object></div>                <script type='text/javascript'>                    var divElement = document.getElementById('viz1586059255126');                    var vizElement = divElement.getElementsByTagName('object')[0];                    if ( divElement.offsetWidth > 800 ) { vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';} else if ( divElement.offsetWidth > 500 ) { vizElement.style.width='100%';vizElement.style.height=(divElement.offsetWidth*0.75)+'px';} else { vizElement.style.width='100%';vizElement.style.height='550px';}                     var scriptElement = document.createElement('script');                    scriptElement.src = 'https://public.tableau.com/javascripts/api/viz_v1.js';                    vizElement.parentNode.insertBefore(scriptElement, vizElement);                </script>
                            </div>
                        </div>
                        <div id="persebaran-kecamatan-dot" class="tab-pane fade">
                            <div class="pt-md-2">
                                <h2>Coming Soon</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    {{-- <svg class="mr-sm-1" width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="7" cy="7.50739" r="7" fill="#8E2DDB"/>
                    </svg> ODP (Orang Dalam Pemantauan)
                    
                    <svg class="mr-sm-1" width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="7" cy="7.50739" r="7" fill="#FFA51F"/>
                    </svg> PDP (Pasien Dalam Pengawasan)

                    <svg class="mr-sm-1" width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="7" cy="7.50739" r="7" fill="#D62522"/>
                    </svg> COVID-19 Dirawat

                    <svg class="mr-sm-1" width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="7" cy="7.50739" r="7" fill="black"/>
                    </svg> COVID-19 Meninggal --}}
                    
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('script')
{{ Html::script('main/js/echart.min.js') }}

<script type="text/javascript">
	$('document').ready(function(){

        // chart line odp pdp covid
        let chartLineData = <?php echo json_encode($chartLine) ?>;
        // line ODP
        const domOdp = document.getElementById('grafik-odp');
        const chartOdp = echarts.init(domOdp)
        optionOdp = {
            tooltip: {
                trigger: 'axis',
            },
            title: {
                text: 'Pertumbuhan Kasus ODP COVID-19 di Jawa Tengah',
                x : 'center',
                subtext: 'Data diambil pada '+ new Date(),
            },
            /* legend: {
                data:['ODP proses', 'ODP selesai'],
                align: 'left'
            }, */
            xAxis: {
                type: 'category',
                boundaryGap: false,
                axisLabel: {
                    formatter: function (value) {
                        return value.split('-').reverse().join('-').substring(0,5)
                    }
                }
            },
            yAxis: {
                name: 'Jumlah kasus',
                type: 'value',
            },
            dataset: {
                source: chartLineData
            },
            dataZoom: [{
                type: 'inside',
                start: 0,
                end: 100
            }, {
                start: 0,
                end: 100,
                handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                handleSize: '80%',
                handleStyle: {
                    color: '#fff',
                    shadowBlur: 3,
                    shadowColor: 'rgba(0, 0, 0, 0.6)',
                    shadowOffsetX: 2,
                    shadowOffsetY: 2
                }
            }],
            series: [
                {
                    name: 'ODP proses',
                    type: 'line',
                    symbol: 'none',
                    // sampling: 'average',
                    itemStyle: {
                        color: 'rgb(196, 226, 27)'
                    },
                    encode: {x: 'tanggal', y:'odp_berjalan'}
                },
                {
                    name: 'ODP selesai',
                    type: 'line',
                    symbol: 'none',
                    // sampling: 'average',
                    itemStyle: {
                        color: '#770EF5'
                    },
                    encode: {x: 'tanggal', y: 'odp_selesai'}
                }
            ]
        };
        chartOdp.setOption(optionOdp)

        // line PDP
        const domPdp = document.getElementById('grafik-pdp');
        const chartPdp = echarts.init(domPdp)
        optionPdp = {
            tooltip: {
                trigger: 'axis',
            },
            title: {
                text: 'Pertumbuhan Kasus PDP COVID-19 di Jawa Tengah',
                x : 'center',
                subtext: 'Data diambil pada '+ new Date(),
            },
            /* legend: {
                data:['ODP proses', 'ODP selesai'],
                align: 'left'
            }, */
            xAxis: {
                type: 'category',
                boundaryGap: false,
                axisLabel: {
                    formatter: function (value) {
                        return value.split('-').reverse().join('-').substring(0,5)
                    }
                }
            },
            yAxis: {
                name: 'Jumlah kasus',
                type: 'value',
            },
            dataset: {
                source: chartLineData
            },
            dataZoom: [{
                type: 'inside',
                start: 0,
                end: 100
            }, {
                start: 0,
                end: 100,
                handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                handleSize: '80%',
                handleStyle: {
                    color: '#fff',
                    shadowBlur: 3,
                    shadowColor: 'rgba(0, 0, 0, 0.6)',
                    shadowOffsetX: 2,
                    shadowOffsetY: 2
                }
            }],
            series: [
                {
                    name: 'PDP dirawat',
                    type: 'line',
                    symbol: 'none',
                    // sampling: 'average',
                    itemStyle: {
                        color: 'rgb(196, 226, 27)'
                    },
                    encode: {x: 'tanggal', y:'pdp_dirawat'}
                },
                {
                    name: 'PDP sembuh',
                    type: 'line',
                    symbol: 'none',
                    // sampling: 'average',
                    itemStyle: {
                        color: '#770EF5'
                    },
                    encode: {x: 'tanggal', y: 'pdp_sembuh'}
                },
                {
                    name: 'PDP meninggal',
                    type: 'line',
                    symbol: 'none',
                    // sampling: 'average',
                    itemStyle: {
                        color: 'red'
                    },
                    encode: {x: 'tanggal', y: 'pdp_meninggal'}
                }
            ]
        };
        chartPdp.setOption(optionPdp)

        // line Covid
        const domCovid = document.getElementById('grafik-covid');
        const chartCovid = echarts.init(domCovid)
        optionCovid = {
            tooltip: {
                trigger: 'axis',
            },
            title: {
                text: 'Pertumbuhan Kasus Positif COVID-19 di Jawa Tengah',
                x : 'center',
                subtext: 'Data diambil pada '+ new Date(),
            },
            /* legend: {
                data:['ODP proses', 'ODP selesai'],
                align: 'left'
            }, */
            xAxis: {
                type: 'category',
                boundaryGap: false,
                axisLabel: {
                    formatter: function (value) {
                        return value.split('-').reverse().join('-').substring(0,5)
                    }
                }
            },
            yAxis: {
                name: 'Jumlah kasus',
                type: 'value',
            },
            dataset: {
                source: chartLineData
            },
            dataZoom: [{
                type: 'inside',
                start: 0,
                end: 100
            }, {
                start: 0,
                end: 100,
                handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                handleSize: '80%',
                handleStyle: {
                    color: '#fff',
                    shadowBlur: 3,
                    shadowColor: 'rgba(0, 0, 0, 0.6)',
                    shadowOffsetX: 2,
                    shadowOffsetY: 2
                }
            }],
            series: [
                {
                    name: 'Covid dirawat',
                    type: 'line',
                    symbol: 'none',
                    // sampling: 'average',
                    itemStyle: {
                        color: 'rgb(196, 226, 27)'
                    },
                    encode: {x: 'tanggal', y:'covid_dirawat'}
                },
                {
                    name: 'Covid sembuh',
                    type: 'line',
                    symbol: 'none',
                    // sampling: 'average',
                    itemStyle: {
                        color: '#770EF5'
                    },
                    encode: {x: 'tanggal', y: 'covid_sembuh'}
                },
                {
                    name: 'Covid meninggal',
                    type: 'line',
                    symbol: 'none',
                    // sampling: 'average',
                    itemStyle: {
                        color: 'red'
                    },
                    encode: {x: 'tanggal', y: 'covid_meninggal'}
                }
            ]
        };
        chartCovid.setOption(optionCovid)

        // line All (odp, pdp, covid)
        const domAll = document.getElementById('grafik-all');
        const chartAll = echarts.init(domAll)
        optionAll = {
            tooltip: {
                trigger: 'axis',
            },
            title: {
                text: 'Pertumbuhan Kasus COVID-19 di Jawa Tengah',
                x : 'center',
                subtext: 'Data diambil pada '+ new Date(),
            },
            /* legend: {
                data:['ODP proses', 'ODP selesai'],
                align: 'left'
            }, */
            xAxis: {
                type: 'category',
                boundaryGap: false,
                axisLabel: {
                    formatter: function (value) {
                        return value.split('-').reverse().join('-').substring(0,5)
                    }
                }
            },
            yAxis: {
                name: 'Jumlah kasus',
                type: 'value',
            },
            dataset: {
                source: chartLineData
            },
            dataZoom: [{
                type: 'inside',
                start: 0,
                end: 100
            }, {
                start: 0,
                end: 100,
                handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                handleSize: '80%',
                handleStyle: {
                    color: '#fff',
                    shadowBlur: 3,
                    shadowColor: 'rgba(0, 0, 0, 0.6)',
                    shadowOffsetX: 2,
                    shadowOffsetY: 2
                }
            }],
            series: [
                {
                    name: 'ODP',
                    type: 'line',
                    symbol: 'none',
                    // sampling: 'average',
                    itemStyle: {
                        color: '#770EF5'
                    },
                    encode: {x: 'tanggal', y:'odp'}
                },
                {
                    name: 'PDP',
                    type: 'line',
                    symbol: 'none',
                    // sampling: 'average',
                    itemStyle: {
                        color: '#FFA51F'
                    },
                    encode: {x: 'tanggal', y: 'pdp'}
                },
                {
                    name: 'Covid',
                    type: 'line',
                    symbol: 'none',
                    // sampling: 'average',
                    itemStyle: {
                        color: '#F92925'
                    },
                    encode: {x: 'tanggal', y: 'covid'}
                }
            ]
        };
        chartAll.setOption(optionAll)

        // option grafik kab/kota
        const dataGrafikKabKota = <?php echo json_encode($kabkot_grafik) ?>;
        // odp
        const gkk = document.getElementById('grafik-kabkot-odp')
        const grafikKabkot = echarts.init(gkk)
        optionGKK = {
            title: {
                text: 'Jumlah Kasus ODP COVID-19 di Jawa Tengah',
                x: 'center',
                subtext: 'Data diambil pada '+ new Date()
            },
            tooltip: {
                trigger: 'axis',
                position: function (pt) {
                    return [pt[0], '10%'];
                }
            },
            grid: {
                bottom: 120,
            },
            xAxis: {
                type: 'category',
                axisLabel: {
                    interval: 0,
                    rotate: 90
                },
            },
            yAxis: {
                type: 'value',
                name: 'Jumlah kasus',
            },
            dataset: {
                source: dataGrafikKabKota.sort(function(a, b) {
                    return b.odp - a.odp;
                })
            },
            series: {
                type: 'bar',
                name: 'ODP',
                encode: {x: 'name', y: 'odp'},
                itemStyle: {
                    color: '#8E2DDB'
                },
                label: {
                    show: true,
                    position: 'top'
                },
            }
        }
        grafikKabkot.setOption(optionGKK)

        // pdp
        const gkkPDP = document.getElementById('grafik-kabkot-pdp')
        const grafikKabkotPDP = echarts.init(gkkPDP)
        optionGKKPDP = {
            title: {
                text: 'Jumlah Kasus PDP COVID-19 di Jawa Tengah',
                x: 'center',
                subtext: 'Data diambil pada '+ new Date()
            },
            tooltip: {
                trigger: 'axis',
                position: function (pt) {
                    return [pt[0], '10%'];
                }
            },
            grid: {
                bottom: 120,
            },
            xAxis: {
                type: 'category',
                axisLabel: {
                    interval: 0,
                    rotate: 90
                },
            },
            yAxis: {
                type: 'value',
                name: 'Jumlah kasus',
            },
            dataset: {
                source: dataGrafikKabKota.sort(function(a, b) {
                    return b.pdp_total - a.pdp_total
                })
            },
            series: {
                type: 'bar',
                name: 'PDP',
                encode: {x: 'name', y: 'pdp_total'},
                itemStyle: {
                    color: '#FFA51F'
                },
                label: {
                    show: true,
                    position: 'top'
                },
            }
        }
        grafikKabkotPDP.setOption(optionGKKPDP)

        // pdp
        const gkkCOVID = document.getElementById('grafik-kabkot-covid')
        const grafikKabkotCovid = echarts.init(gkkCOVID)
        optionGKKCovid = {
            title: {
                text: 'Kasus Positif COVID-19 di Jawa Tengah',
                x: 'center',
                subtext: 'Data diambil pada '+ new Date()
            },
            tooltip: {
                trigger: 'axis',
                position: function (pt) {
                    return [pt[0], '10%'];
                }
            },
            grid: {
                bottom: 120,
            },
            xAxis: {
                type: 'category',
                axisLabel: {
                    interval: 0,
                    rotate: 90
                },
            },
            yAxis: {
                type: 'value',
                name: 'Jumlah kasus',
            },
            dataset: {
                source: dataGrafikKabKota.sort(function(a, b) {
                    return b.cov_total - a.cov_total
                })
            },
            series: {
                type: 'bar',
                name: 'Covid',
                encode: {x: 'name', y: 'cov_total'},
                itemStyle: {
                    color: '#D62522'
                },
                label: {
                    show: true,
                    position: 'top'
                },
            }
        }
        grafikKabkotCovid.setOption(optionGKKCovid)
    });
</script>
@endsection
