<table class="table table-sm table-striped table-bordered text-center" id="table-report-kab">
    <thead>
    <tr>
        <th rowspan="2">Puskesmas</th>
        <th colspan="3">Kasus Terkonfirmasi</th>
    </tr>
    <tr>
        <th>Terkonfirmasi</th>
        <th>Tracing</th>
        <th>Perbandingan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $i)
        <tr>
            @php($perbandingan = ($i->total_tracing>1 and $i->total_confirm >1)?(int) $i->total_tracing/$i->total_confirm:0)
            <td class="text-left">{{$i->name}}</td>
            <td>{{Helper::NUMBER($i->total_confirm)}}</td>
            <td>{{Helper::NUMBER($i->total_tracing) }}</td>
            <td>1 : {{$perbandingan<0?'<1':(int)$perbandingan}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

