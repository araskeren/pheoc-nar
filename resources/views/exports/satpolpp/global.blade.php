<table>
    <thead class="text-center">
        <tr>
            <th rowspan="2">Kab/Kota</th>
            <th rowspan="2">Total</th>
            <th colspan="2">Jenis Kelamin</th>
            <th colspan="3">Usia</th>
            <th colspan="3">Pekerjaan</th>
            <th colspan="5">Sanksi</th>
        </tr>
        <tr>
            <th>Pria</th>
            <th>Wanita</th>
            <th>Kurang dari 19</th>
            <th>20-39</th>
            <th>Lebih dari 40</th>
            <th>Swasta</th>
            <th>Pelajar/MHS</th>
            <th>PNS/Polri/TNI</th>
            <th>Pancasila</th>
            <th>Push Up</th>
            <th>Menyapu</th>
            <th>Sita KTP</th>
            <th>Denda Uang</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i)
            <tr>
                <td>{{$i->district_name}}</td>
                <td>{{$i->female_total + $i->male_total}}</td>
                <td>{{$i->female_total}}</td>
                <td>{{$i->lower_19_total}}</td>
                <td>{{$i->greater_20_total}}</td>
                <td>{{$i->greater_40_total}}</td>
                <td>{{$i->swasta_total}}</td>
                <td>{{$i->student_total}}</td>
                <td>{{$i->pns_total}}</td>
                <td>{{$i->sanksi_pancasila_total}}</td>
                <td>{{$i->sanksi_push_up_total}}</td>
                <td>{{$i->sanksi_menyapu_total}}</td>
                <td>{{$i->sanksi_sita_ktp_total}}</td>
                <td>{{$i->sanksi_denda_uang_total}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
