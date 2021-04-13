<style>
    th {
        text-align: center;
    }
</style>
<table>
    <thead>
        <tr>
            <th colspan="8">TRACING</th>
            <th colspan="11">RELASI</th>
        </tr>
        <tr>
            <!-- Parent -->
            <th rowspan="2">NAMA</th>
            <th rowspan="2">JK</th>
            <th rowspan="2">UMUR</th>
            <th colspan="3">DOMISILI</th>
            <th rowspan="2">STATUS</th>
            <th rowspan="2">JUMLAH</th>
            <!-- Child -->
            <th rowspan="2">Nama</th>
            <th rowspan="2">JK</th>
            <th rowspan="2">UMUR</th>
            <th colspan="3">DOMISILI</th>
            <th rowspan="2">STATUS</th>
            <th rowspan="2">HUBUNGAN</th>
            <th rowspan="2">KONTAK</th>
            <th rowspan="2">DIBUAT</th>
            <th rowspan="2">UPDATE</th>

        </tr>
        <tr>
            <th>Kab/Kota</th>
            <th>Kecamatan</th>
            <th>Kelurahan</th>
            <th>Kab/Kota</th>
            <th>Kecamatan</th>
            <th>Kelurahan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            @php($childList = json_decode($item->child_array))
            <tr>
                <td>{{$item->parent_name}}</td>
                <td>{{$item->parent_sex}}</td>
                <td>{{$item->parent_age}}</td>
                <td>{{$item->parent_district_name}}</td>
                <td>{{$item->parent_sub_district_name}}</td>
                <td>{{$item->parent_village_name}}</td>
                <td>{{$item->parent_last_status}}</td>
                <td>{{$item->count}}</td>
                <td>{{$childList ? $childList[0]->child_name:'-'}}</td>
                <td>{{$childList ? $childList[0]->child_sex:'-'}}</td>
                <td>{{$childList ? $childList[0]->child_age:'-'}}</td>
                <td>{{$childList ? $childList[0]->child_district_name:'-'}}</td>
                <td>{{$childList ? $childList[0]->child_sub_district_name:'-'}}</td>
                <td>{{$childList ? $childList[0]->child_village_name:'-'}}</td>
                <td>{{$childList ? $childList[0]->child_status:'-'}}</td>
                <td>{{$childList ? $childList[0]->child_relationship_type_name:'-'}}</td>
                <td>{{$childList ? $childList[0]->child_relationship_name:'-'}}</td>
                <td>{{$childList ? $childList[0]->child_created_at:'-'}}</td>
                <td>{{$childList ? $childList[0]->child_updated_at:'-'}}</td>
            </tr>
            @if($childList)
            @foreach($childList as $child)
                @if(!$loop->first)
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$child->child_name}}</td>
                    <td>{{$child->child_sex}}</td>
                    <td>{{$child->child_age}}</td>
                    <td>{{$child->child_district_name}}</td>
                    <td>{{$child->child_sub_district_name}}</td>
                    <td>{{$child->child_village_name}}</td>
                    <td>{{$child->child_status}}</td>
                    <td>{{$child->child_relationship_type_name}}</td>
                    <td>{{$child->child_relationship_name}}</td>
                    <td>{{$child->child_created_at}}</td>
                    <td>{{$child->child_updated_at}}</td>
                </tr>
                @endif
            @endforeach
            @endif

        @endforeach
    </tbody>
</table>
