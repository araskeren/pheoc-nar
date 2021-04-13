<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>NIK</th>
            <th>NAMA</th>
            <th>UMUR</th>
            <th>JK</th>
            <th>KAB/KOTA</th>
            <th>KECAMATAN</th>
            <th>KELURAHAN</th>
            <th>RT</th>
            <th>RW</th>
            <th>ALAMAT</th>
            <th>KONDISI UMUM</th>
            <th>TINDAKAN</th>
            <th>STATUS</th>
            <th>RUMAH SAKIT</th>
            <th>LINI</th>
            <th>JUMLAH KONTAK</th>
            <th>TGL LAPOR</th>
            <th>TGL LAPOR SISTEM</th>
            <th>TGL PASIEN DI BUAT SISTEM</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            <tr>
                <td>{{$item->num_id}}</td>
                <td>{{$item->nik}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->age}}</td>
                <td>{{$item->sex}}</td>
                <td>{{$item->kab_name}}</td>
                <td>{{$item->kec_name}}</td>
                <td>{{$item->kel_name}}</td>
                <td>{{$item->rt}}</td>
                <td>{{$item->rw}}</td>
                <td>{{$item->address}}</td>
                <td>{{$item->common_condition}}</td>
                <td>{{$item->treatment}}</td>
                <td>{{$item->status_name}}</td>
                <td>{{$item->rumah_sakit_name}}</td>
                <td>{{$item->rumah_sakit_lini}}</td>
                <td>{{$item->contact_count}}</td>
                <td>{{$item->reported_date}}</td>
                <td>{{$item->last_update}}</td>
                <td>{{$item->patient_created_at}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
