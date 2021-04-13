<table>
    <thead>
        <tr>
            <th>TANGGAL PELAPORAN</th>
            <th>Konfirmasi Harian</th>
            <th>Konfirmasi Komulatif</th>
            <th>Sembuh Harian</th>
            <th>Sembuh Kumulatif</th>
            <th>Meninggal Harian</th>
            <th>Meninggal Kumulatif</th>
            <th>Recv Rate (%)</th>
            <th>CFR %</th>
            <th>Kasus Aktif</th>
            <th>Kasus Test Harian</th>
            <th>Kasus Test Kum</th>
            <th>Kasus Neg Harian</th>
            <th>Kasus Neg Kum</th>
            <th>Pos Rate (%)</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $i)
        @if($i->tanggal == '2020-12-31')
            <tr>
                <td>Komulatif 2020</td>
                <td>0</td>
                <td>{{$i->total_konfirm_kumulatif}}</td>
                <td>0</td>
                <td>{{$i->total_sembuh_kumulatif}}</td>
                <td>0</td>
                <td>{{$i->total_meninggal_kumulatif}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        @elseif($i->tanggal >= '2021-01-01')
            <tr>
                <td>{{\Carbon\Carbon::parse($i->tanggal)->format("d/m/Y")}}</td>
                <td>{{$i->total_konfirm_harian}}</td>
                <td>{{$i->total_konfirm_kumulatif}}</td>
                <td>{{$i->total_sembuh_harian}}</td>
                <td>{{$i->total_sembuh_kumulatif}}</td>
                <td>{{$i->total_meninggal_harian}}</td>
                <td>{{$i->total_meninggal_kumulatif}}</td>
                <td>{{number_format($i->recovery_rate,2)}}</td>
                <td>{{number_format($i->cfr,2)}}</td>
                <td>{{$i->kasus_aktif}}</td>
                <td>{{$i->total_test_harian}}</td>
                <td>{{$i->total_test_harian_kumulatif}}</td>
                <td>{{$i->total_test_negatif}}</td>
                <td>{{$i->total_test_negatif_kumulatif}}</td>
                <td>{{number_format($i->positivity_rate,2)}}</td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
