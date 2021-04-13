<table>
    <thead>
        <tr>
            <th>Stakeholder</th>
            <th>Lini</th>
            <th>Baju Pelindung</th>
            <th>Sepatu Boots</th>
            <th>Google</th>
            <th>Masker N95</th>
            <th>Masker Bedah</th>
            <th>VTM</th>
            <th>Rapid Test</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i)
            <tr>
                <td>{{$i->stakeholder}}</td>
                <td>{{$i->lini}}</td>
                <td>{{$i->baju_pelindung}}</td>
                <td>{{$i->sepatu_boots}}</td>
                <td>{{$i->google}}</td>
                <td>{{$i->masker_n95}}</td>
                <td>{{$i->masker_bedah}}</td>
                <td>{{$i->vtm}}</td>
                <td>{{$i->rapid_test}}</td>
            </tr>
        @endforeach
    </tbody>
</table>