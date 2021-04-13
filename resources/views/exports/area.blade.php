<table>
    <thead>
        <tr>
            <th>ID Kabupaten / Kota</th>
            <th>ID Kecamatan</th>
            <th>ID Kelurahan / Desa</th>
            <th>Nama Kabupaten / Kota</th>
            <th>Nama Kecamatan</th>
            <th>Nama Desa / Kelurahan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i)
            <tr>
                <td>{{$i->kab_id}}</td>
                <td>{{$i->kec_id}}</td>
                <td>{{$i->kel_id}}</td>
                <td>{{$i->kab_name}}</td>
                <td>{{$i->kec_name}}</td>
                <td>{{$i->kel_name}}</td>
            </tr>
        @endforeach
    </tbody>
</table>