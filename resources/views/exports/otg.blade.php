<table>
    <thead>
        <tr>
            <th>PERSON ID</th>
            <th>NAMA</th>
            <th>KABUPATEN</th>
            <th>KECAMATAN</th>
            <th>KELURAHAN</th>
            <th>ALAMAT</th>
            <th>UMUR</th>
            <th>JENIS KELAMIN</th>
            <th>NO. TELP</th>
            <th>RIWAYAT PERJALANAN</th>
            <th>TGL SAMPAI DI INDONESIA</th>
            <th>TGL PEMANTAUAN AWAL</th>
            <th>TGL PEMANTAUAN AKHIR</th>
            <th>GEJALAN</th>
            <th>KONDISI UMUM AKHIR</th>
            <th>KETERANGAN</th>
            <th>STATUS</th>
            <th>TGL LAPOR</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ ($item->district_name)?$item->district_name:'-'}}</td>
                <td>{{ ($item->subdistrict_name)?$item->subdistrict_name:'-'}}</td>
                <td>{{ ($item->village_name)?$item->village_name:'-'}}</td>
                <td>{{ ($item->address)?$item->address:'-' }}</td>
                <td>{{ $item->age }}</td>
                <td>{{ $item->sex }}</td>
                <td>{{ $item->phone_number }}</td>
                <td>{{ $item->riwayat_perjalanan_negara }}</td>
                <td>{{ ($item->tgl_sampai_di_indonesia)?$item->tgl_sampai_di_indonesia:'-' }}</td>
                <td>{{ ($item->pemantauan_awal)?$item->pemantauan_awal:'-' }}</td>
                <td>{{ ($item->pemantauan_akhir)?$item->pemantauan_akhir:'-' }}</td>
                <td>{{ $item->gejala }}</td>
                <td>{{ $item->kondisi_umum_akhir }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>
                    @if($item->status == 0)
                        Berjalan
                    @elseif($item->status == 1)
                        Selesai
                    @else
                        Tidak Diketahui
                    @endif
                </td>
                <td>{{ $item->reported_date}}</td>
            </tr>
        @endforeach
    </tbody>
</table>