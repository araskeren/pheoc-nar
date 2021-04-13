@extends('auth')
@section('title', ucfirst(Request::segment(1)).Request::segment(2) ? ucfirst(Request::segment(1)) : " - ".ucfirst(Request::segment(1)))
@section('content')
<style type="text/css">
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
            <div class="row">
                <div class="col-md-4">
                    <div class="card border border-primary">
                        <div class="pt-md-3" style="background-color: #DDF2FE;">
                            <div class="text-center h5">Total Deteksi Mandiri</div>
                            <div class="text-center font-weight-normal" style="color: #8E2DDB; font-size: 42px">
                                <b>{{number_format($count_deteksi[0]->anjuran_periksa_rs + $count_deteksi[0]->isolasi_mandiri + $count_deteksi[0]->sehat, 0, ',', '.')}}</b>
                            </div>
                        </div>
                        <div class="">
                            <div class="d-flex justify-content-between p-2">
                                <div>Periksa COVID-19</div>
                                <div class="font-weight-bold" style="color: #FF4D4A;">{{number_format($count_deteksi[0]->anjuran_periksa_rs, 0, ',', '.')}}</div>
                            </div>
                            <hr class="my-md-0">
                            <div class="d-flex justify-content-between p-2">
                                <div>Isolasi Mandiri</div>
                                <div style="font-size: 18px; color: #FFA51F;">{{number_format($count_deteksi[0]->isolasi_mandiri, 0, ',', '.')}}</div>
                            </div>
                            <hr class="my-md-0">
                            <div class="d-flex justify-content-between p-2">
                                <div>Sehat</div>
                                <div style="font-size: 18px; color: #27AE60">{{number_format($count_deteksi[0]->sehat, 0, ',', '.')}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="card border border-primary">
                        <div class="p-2">
                            <div id="pie-deteksi-dini" style="height: 270px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold">Grafik Pertumbuhan Keikutsertaan Deteksi Dini oleh Masyarakat Jawa Tengah </h5>
                        </div>
                        <div class="mt-sm-2">
                            <div id="line-deteksi-dini" style="height: 445px;"></div>
                        </div>
                        <div class="card-footer">
                            <svg class="mr-sm-2" width="26" height="14" viewBox="0 0 26 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 7C20 10.866 16.866 14 13 14C9.13401 14 6 10.866 6 7C6 3.13401 9.13401 0 13 0C16.866 0 20 3.13401 20 7Z" fill="#2D9CDB"/>
                                <rect y="6" width="26" height="2" rx="1" fill="#2D9CDB"/>
                            </svg> Jumlah Orang yang mengikuti Deteksi Dini
                                
                        </div>
                    </div>
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
        // deteksi dini pie
        let PieData = <?php echo json_encode($count_deteksi) ?>;
        // let PieData = [{"sehat":"564376","isolasi_mandiri":"65282","anjuran_periksa_rs":"6469"}];
        const domPie = document.getElementById('pie-deteksi-dini');
        const chartDeteksi = echarts.init(domPie)
        const optionPie = {
            tooltip: {
                trigger: 'item',
            },
            series: [
                {
                    name: 'Deteksi mandiri',
                    type: 'pie',
                    data: [
                        {
                            name: 'Isolasi \nMandiri',
                            value: PieData[0].isolasi_mandiri,
                            label: {
                                color: '#FFA51F',
                                fontWeight: 'bold',
                                fontSize: 14,
                                align: 'left',
                                verticalAlign: 'bottom'
                            },
                            itemStyle: {
                                color: '#FFA51F'
                            }
                        },
                        {
                            name: 'Sehat',
                            value: PieData[0].sehat,
                            label: {
                                color: '#27AE60',
                                fontWeight: 'bold',
                                fontSize: 14,
                                align: 'left',
                                verticalAlign: 'bottom'
                            },
                            itemStyle: {
                                color: '#27AE60'
                            }
                        },
                        {
                            name: 'Periksa \nCOVID-19',
                            value: PieData[0].anjuran_periksa_rs,
                            label: {
                                color: '#FF4D4A',
                                fontWeight: 'bold',
                                fontSize: 14,
                                align: 'left',
                                verticalAlign: 'bottom'
                            },
                            itemStyle: {
                                color: '#FF4D4A'
                            }
                        },
                    ],
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]
        };
        chartDeteksi.setOption(optionPie)

        let chartLineData = <?php echo json_encode($deteksi_chart_line) ?>;
        const domLine = document.getElementById('line-deteksi-dini');
        const LineDeteksi = echarts.init(domLine)
        optionLine = {
            tooltip: {
                trigger: 'axis',
            },
            title: {
                text: 'Grafik Keikutsertaan Deteksi Dini di Jawa Tengah',
                x : 'center',
                subtext: 'Data diambil pada '+ new Date(),
            },
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
                name: 'Jumlah Orang',
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
                    name: 'Peserta',
                    type: 'line',
                    symbol: 'none',
                    // sampling: 'average',
                    itemStyle: {
                        color: '#2D9CDB'
                    },
                    encode: {x: 'tanggal', y:'jumlah'}
                }
            ]
        };
        LineDeteksi.setOption(optionLine)
    })
</script>
@endsection