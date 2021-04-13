<table>
    <thead>
        <tr>
            <th>PERSON ID</th>
            <th>SAMPLE CODE</th>
            <th>PERIODE SWAB</th>
            <th>NAMA</th>
            <th>KABUPATEN</th>
            <th>KECAMATAN</th>
            <th>DESA/KEL</th>
            <th>ALAMAT</th>
            <th>UMUR</th>
            <th>KELAMIN</th>
            <th>NAMA RS</th>
            <th>NAMA LAB</th>
            <th>TGL DIKIRIM</th>
            <th>TGL DITERIMA</th>
            <th>TGL SELESAI</th>
            <th>HASIL</th>
            <th>CREATED_AT</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)    
            <tr>
                <td>{{ $data->person_id }}</td>
                <td>{{ $data->sample_code }}</td>
                <td>{{ $data->swab_period }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->kab_name }}</td>
                <td>{{ $data->kec_name }}</td>
                <td>{{ $data->kel_name }}</td>
                <td>{{ $data->address }}</td>
                <td>{{ $data->age }}</td>
                <td>{{ $data->sex }}</td>
                <td>{{ $data->hospital_name }}</td>
                <td>{{ $data->lab_name }}</td>
                <td>{{ $data->tanggal_dikirim }}</td>
                <td>{{ $data->tanggal_diterima }}</td>
                <td>{{ $data->tanggal_selesai }}</td>
                <td>
                    @if ($data->result == '0')
                        Negatif
                    @elseif($data->result)
                        Positif
                    @else
                        Undefined
                    @endif
                </td>
                <td>{{ $data->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>