<table>
    <thead>
        <tr>
            <th>Instansi</th>
            <th>Fasilitas</th>
            <th>Deskripsi</th>
            <th>Kapasitas</th>
            <th>Terpakai</th>
            <th>Tersedia</th>
            <th>Update</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i)
            <tr>
                <td>{{$i->stakeholder_name}}</td>
                <td>{{$i->facility_name}}</td>
                <td>{{$i->facility_description}}</td>
                <td>{{$i->total}}</td>
                <td>{{$i->used}}</td>
                <td>{{$i->available}}</td>
                <td>{{$i->updated_at}}</td>
            </tr>
        @endforeach
    </tbody>
</table>