<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Total Konfirmasi</th>
            <th>Total Tracing</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i)
            <tr>
                <td>{{$i->nama}}</td>
                <td>{{$i->total_confirm}}</td>
                <td>{{$i->total_tracing}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
