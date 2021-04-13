<table>
    <thead>
        <tr>
            <th>Pengirim</th>
            <th>Penerima</th>
            <th>Total</th>
            <th>No Surat Jalan</th>
            <th>Tgl Dibuat</th>
            <th>Disetujui</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i)
            <tr>
                <td>{{$i->sender_name}}</td>
                <td>{{$i->receiver_name}}</td>
                <td>{{$i->total}}</td>
                <td>{{$i->letter_number}}</td>
                <td>{{$i->created_at}}</td>
                <td>{{$i->is_approve}}</td>
            </tr>
        @endforeach
    </tbody>
</table>