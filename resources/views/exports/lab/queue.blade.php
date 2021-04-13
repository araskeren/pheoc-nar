<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Kab/Kota</th>
            <th>Kecamatan</th>
            <th>Kelurahan</th>
            <th>Alamat</th>
            <th>Umur</th>
            <th>Jenis Kelamin</th>
            <th>Asal Test</th>
            <th>LAB</th>
            <th>SWAB</th>
            <th>Spesimen</th>
            <th>Tanggal Pengajuan</th>
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
                <td>{{$i->swab_period}}</td>
                <td>{{$i->speciment_name}}</td>
                <td>{{$i->created_at}}</td>
            </tr>
        @endforeach
    </tbody>
</table>