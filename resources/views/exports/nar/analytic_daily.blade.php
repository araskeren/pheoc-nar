<style>
    th {
        text-align: center;
    }
</style>
<table>
    <thead>
    <tr>
        <th rowspan="2">TANGGAL PELAPORAN</th>
        @for($i = 0;$i<count($kabKota);$i++)
            <th colspan="8">{{$kabKota[$i]->name}}</th>
        @endfor
    </tr>
    <tr>
        @for($i = 0;$i<count($kabKota);$i++)
{{--            <th>Debug</th>--}}
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
        @if($date->tanggal >= '2021-01-01')
            <tr>
                <td>{{\Carbon\Carbon::parse($date->tanggal)->format("d/m/Y")}}</td>
                @for($i = 0;$i<count($kabKota);$i++)
                    @foreach($datas as $data)
                        @if($kabKota[$i]->name == $data->kabupaten and $data->tanggal == $date->tanggal)
{{--                            <td>{{$data->kabupaten}} - {{$data->tanggal}}</td>--}}
                            <td>{{$data->total_konfirm_harian}}</td>
                            <td>{{$data->total_konfirm_kumulatif}}</td>
                            <td>{{$data->total_sembuh_harian}}</td>
                            <td>{{$data->total_sembuh_kumulatif}}</td>
                            <td>{{$data->total_meninggal_harian}}</td>
                            <td>{{$data->total_meninggal_kumulatif}}</td>
                            <td>{{$data->total_test_negatif}}</td>
                            <td>{{$data->total_test_negatif_kumulatif}}</td>
                        @endif
                    @endforeach
                @endfor
            </tr>
        @endif
    @endforeach

    </tbody>
</table>
