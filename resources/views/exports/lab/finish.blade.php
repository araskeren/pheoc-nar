<table>
    <thead>
        {{-- <tr>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Kab/Kota</th>
            <th rowspan="2">Kecamatan</th>
            <th rowspan="2">Kelurahan</th>
            <th rowspan="2">Alamat</th>
            <th rowspan="2">Umur</th>
            <th rowspan="2">Jenis Kelamin</th>
            <th rowspan="2">Asal Test</th>
            <th colspan="7">LAB</th>
            <th rowspan="2">Tanggal Pengajuan</th>
        </tr>
        <tr>
            <th>Nama</th>
            <th>Hasil</th>
            <th>SWAB Ke</th>
            <th>Spesimen</th>
            <th>Tanggal</th>
            <th>Kode</th>
        </tr> --}}
        <tr>
            <th>Nama</th>
            <th>Kab/Kota</th>
            <th>Kecamatan</th>
            <th>Kelurahan</th>
            <th>Alamat</th>
            <th>Umur</th>
            <th>Jenis Kelamin</th>
            <th>Asal Test</th>
            <th>Nama LAB</th>
            <th>Hasil</th>
            <th>SWAB Ke</th>
            <th>Spesimen</th>
            <th>Tanggal Test</th>
            <th>Kode Sample</th>
            <th>Tanggal Dikirim</th>
            <th>Tanggal Diterima</th>
            <th>Tanggal Selesai</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i)
            <tr>
                <td>{{$i->name}}</td>
                <td>{{$i->kab_name}}</td>
                <td>{{$i->kec_name}}</td>
                <td>{{$i->kel_name}}</td>
                <td>{{$i->address}}</td>
                <td>{{$i->age}}</td>
                <td>{{$i->sex}}</td>
                <td>{{$i->hospital_name}}</td>
                <td>{{$i->lab_name}}</td>
                <td>
                    @if($i->test_result == 1)
                        Positif
                    @elseif($i->test_result == 2)
                        Inkonklusif
                    @elseif($i->test_result == 3)
                        Invalid
                    @elseif($i->test_result == 4)
                        SWAB Ulang
                    @elseif($i->test_result == 5)
                        PCR Ulang
                    @else
                        Negatif
                    @endif
                </td>
                <td>{{$i->swab_period}}</td>
                <td>{{$i->speciment_name}}</td>
                <td>{{$i->test_date}}</td>
                <td>{{$i->sample_code}}</td>
                <td>{{$i->tanggal_dikirim}}</td>
                <td>{{$i->tanggal_diterima}}</td>
                <td>{{$i->tanggal_selesai}}</td>
            </tr>
        @endforeach
    </tbody>
</table>