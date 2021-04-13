
<h4>DAFTAR HASIL LAB PASIEN</h4>
<h4>PROVINSI JAWA TENGAH</h4>
<h4>FASKES PENGINPUT SPESIMEN {{$hospitalName}}</h4>
<h4>TANGGAL HASIL LAB {{$date}}</h4>
<br>
<br>
<p>Keadaan Tanggal : {{now()->format('d-m-Y H:i:s')}}</p>
<table>
    <thead>
    <tr>
        <th rowspan="2">No</th>
        <th rowspan="2">Nama</th>
        <th colspan="3" align="center">Identitas</th>
        <th rowspan="2">Tgl Lahir</th>
        <th colspan="2" align="center">Usia</th>
        <th rowspan="2">JK</th>
        <th rowspan="2">No Telp</th>
        <th colspan="7" align="center">Alamat Domisili Saat ini</th>
        <th rowspan="2" align="center">Faskes</th>
        <th colspan="5" align="center">LAB</th>
        <th colspan="6" align="center">TANGGAL</th>
    </tr>
    <tr>
        <th>No</th>
        <th>Kewarganegaraan</th>
        <th>Negara</th>
        <th>Tahun</th>
        <th>Bulan</th>
        <th>Propinsi</th>
        <th>Kab/Kota</th>
        <th>Kecamatan</th>
        <th>Kelurahan</th>
        <th>RW</th>
        <th>RT</th>
        <th>Alamat</th>
        <th>Sampel Ke</th>
        <th>No Spesimen</th>
        <th>Jenis Spesimen</th>
        <th>Laboratorium Pemeriksa</th>
        <th>Hasil</th>
        <th>Pengambilan</th>
        <th>Pengiriman</th>
        <th>Terima</th>
        <th>Periksa</th>
        <th>Input</th>
        <th>Kirim All Record</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $i)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$i->name}}</td>
            <td>{{"'".$i->identity}}</td>
            <td>{{$i->identity_type}}</td>
            <td>{{$i->identity_nationality}}</td>
            <td>{{$i->birth_date}}</td>
            <td>{{$i->age_year}}</td>
            <td>{{$i->age_month}}</td>
            <td>{{$i->sex}}</td>
            <td>{{$i->phone_number}}</td>
            <td>{{$i->province_name}}</td>
            <td>{{$i->district_name}}</td>
            <td>{{$i->sub_district_name}}</td>
            <td>{{$i->village_name}}</td>
            <td>{{$i->rw}}</td>
            <td>{{$i->rt}}</td>
            <td>{{$i->address}}</td>
            <td>{{$i->faskes_name}}</td>
            <td>{{$i->swab_period}}</td>
            <td>{{$i->sample_code}}</td>
            <td>{{$i->speciment_name}}</td>
            <td>{{$i->lab_name}}</td>
            <td>{{$i->result}}</td>
            <td>{{$i->collect_date}}</td>
            <td>{{$i->send_date}}</td>
            <td>{{$i->receive_date}}</td>
            <td>{{$i->test_date}}</td>
            <td>{{$i->created_at}}</td>
            <td>{{$i->send_all_record_date}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
