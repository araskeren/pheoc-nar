<table>
    <thead>
        <tr>
            <th>PERSON ID</th>
            <th>NAMA</th>
            <th>SUMBER RDT</th>
            <th>KABUPATEN</th>
            <th>KECAMATAN</th>
            <th>DESA/KEL</th>
            <th>TEST PLACE</th>
            <th>HASIL</th>
            <th>CREATED_AT</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)    
            <tr>
                <td>{{ $data->odp_id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->area_name }}</td>
                <td>{{ $data->district_name }}</td>
                <td>{{ $data->subdistrict_name }}</td>
                <td>{{ $data->village_name }}</td>
                <td>{{ $data->test_place_name }}</td>
                <td>
                    @if ($data->is_reactive == '0')
                        Non Reaktif
                    @elseif($data->is_reactive)
                        Reaktif
                    @else
                        Undefined
                    @endif
                </td>
                <td>{{ $data->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>