<style>
    th {
        text-align: center;
    }
</style>
<table>
    <thead>
        <tr>
            <th colspan="2">TANGGAL PELAPORAN</th>
            @for($i = 0;$i<count($kabKota);$i++)
                <th colspan="8">{{$kabKota[$i]->name}}</th>
            @endfor
        </tr>
        <tr>
            <th>Week</th>
            <th>RANGE</th>
            @for($i = 0;$i<count($kabKota);$i++)
{{--                <th>Debug</th>--}}
                <th>Konfirmasi Mingguan</th>
                <th>Konfirmasi Mingguan Komulatif</th>
                <th>Sembuh Mingguan</th>
                <th>Sembuh Mingguan Kumulatif</th>
                <th>Meninggal Mingguan</th>
                <th>Meninggal Mingguan Kumulatif</th>
                <th>Kasus Neg Mingguan</th>
                <th>Kasus Neg Mingguan Kum</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @foreach($listDate as $date)
            @if($date->awal >= '2021-01-01')
            <tr>
                <td>{{$date->bulan_minggu}}</td>
                <td>{{\Carbon\Carbon::parse($date->awal)->format("d/m/Y")}} - {{\Carbon\Carbon::parse($date->akhir)->format("d/m/Y")}}</td>
                @for($i = 0;$i<count($kabKota);$i++)
                    @foreach($datas as $data)
                        @if($kabKota[$i]->name == $data->kabupaten and $data->bulan_minggu == $date->bulan_minggu)
{{--                            <td>{{$data->kabupaten}} - {{$data->bulan_minggu}}</td>--}}
                            <td>{{$data->total_konfirm_mingguan}}</td>
                            <td>{{$data->total_konfirm_mingguan_kumulatif}}</td>
                            <td>{{$data->total_sembuh_mingguan}}</td>
                            <td>{{$data->total_sembuh_mingguan_kumulatif}}</td>
                            <td>{{$data->total_meninggal_mingguan}}</td>
                            <td>{{$data->total_meninggal_mingguan_kumulatif}}</td>
                            <td>{{$data->total_test_mingguan_negatif}}</td>
                            <td>{{$data->total_test_negatif_mingguan_kumulatif}}</td>
                        @endif
                    @endforeach
                @endfor
            </tr>
            @endif
        @endforeach

    </tbody>
</table>
