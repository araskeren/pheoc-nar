<table>
    <thead>
        <tr>
            <th>ID Status</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i)
            <tr>
                <td>{{$i->id}}</td>
                <td>{{$i->name}}</td>
            </tr>
        @endforeach
    </tbody>
</table>