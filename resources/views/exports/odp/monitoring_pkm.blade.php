<table>
    <thead>
        <tr>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Kab/Kota</th>
            <th rowspan="2">Kecamatan</th>
            <th colspan="5" align="center">Total</th>
            <th colspan="2" align="center">ODP</th>
            <th colspan="2" align="center">OTG</th>
            <th colspan="2" align="center">SCREENING</th>
        </tr>
        <tr>
            <th>ODP</th>
            <th>OTG</th>
            <th>Screening</th>
            <th>SWAB</th>
            <th>RDT</th>
            <th>RDT</th>
            <th>SWAB</th>
            <th>RDT</th>
            <th>SWAB</th>
            <th>RDT</th>
            <th>SWAB</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $i)
        <tr>
            <td>{{$i->nama}}</td>
            <td>{{$i->district_name}}</td>
            <td>{{$i->subdistrict_name}}</td>
            <td>{{$i->odp_total}}</td>
            <td>{{$i->otg_total}}</td>
            <td>{{$i->screening_total}}</td>
            <td>{{$i->swab_total}}</td>
            <td>{{$i->rdt_total}}</td>
            <td>{{$i->rdt_odp_total}}</td>
            <td>{{$i->swab_odp_total}}</td>
            <td>{{$i->rdt_otg_total}}</td>
            <td>{{$i->swab_otg_total}}</td>
            <td>{{$i->rdt_screening_total}}</td>
            <td>{{$i->swab_screening_total}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
