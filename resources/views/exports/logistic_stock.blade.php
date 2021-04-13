<table>
    <thead>
        <tr>
            <th>Stakeholder</th>
            <th>Nama</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i)
            <tr>
                <td>{{$i->stakeholder}}</td>
                <td>{{$i->name}}</td>
                <td>{{$i->total}}</td>
            </tr>
        @endforeach
    </tbody>
</table>