<h3>LAPORAN  REKAP HASIL PEMERIKSAAN LABORATORIUM COVID-19</h3>
<h3>PROVINSI JAWA TENGAH </h3>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lab</th>
            <th>Tanggal</th>
            <th>Nama Kab/kota asal sampel</th>
            <th>Diperiksa</th>
            <th>Positif</th>
            <th>Negatif</th>
            <th>Dalam Proses</th>
            <th>Inkonklusif</th>
            <th>Invalid</th>
            <th>Pemberi Informasi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->date }}</td>
                <td></td>
                <td>{{ $data->positive + $data->negative + $data->inkonklusif + $data->invalid }}</td>
                <td>{{ $data->positive }}</td>
                <td>{{ $data->negative }}</td>
                <td>{{ $data->process }}</td>
                <td>{{ $data->inkonklusif }}</td>
                <td>{{ $data->invalid }}</td>
                <td>{{ $data->informer }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>
<br>
<h3>Stok Logisitk LAB</h3>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama LAB</th>
            <th>Nama Spesimen</th>
            <th>Merk</th>
            <th>Total</th>
            <th>Tanggal</th>
            <th>Created at</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($logistikStock as $stock)    
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $stock->lab_name }}</td>
                <td>{{ $stock->logistic_name }}</td>
                <td>{{ $stock->merk ?? '-' }}</td>
                <td>{{ $stock->total }}</td>
                <td>{{ $stock->reported_date }}</td>
                <td>{{ $stock->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

