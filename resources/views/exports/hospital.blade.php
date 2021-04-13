<table>
    <thead>
        <tr>
            <th>ID RS</th>
            <th>Nama RS</th>
            <th>Alamat RS</th>
            <th>Kabupaten / Kota</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i)
            <tr>
                <td>{{$i->id}}</td>
                <td>{{$i->nama}}</td>
                <td>{{$i->alamat}}</td>
                <td>{{$i->kabkot}}</td>
            </tr>
        @endforeach
    </tbody>
</table>