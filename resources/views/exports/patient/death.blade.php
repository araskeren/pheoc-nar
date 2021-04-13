<table>
    <thead>
    <tr>
        <th>PERSON ID</th>
        <th>NIK</th>
        <th>NAMA</th>
        <th>KABUPATEN</th>
        <th>KECAMATAN</th>
        <th>KELURAHAN</th>
        <th>ALAMAT</th>
        <th>RT</th>
        <th>RW</th>
        <th>UMUR</th>
        <th>JENIS KELAMIN</th>
        <th>PEKERJAAN</th>
        <th>TEMPAT PEKERJAAN</th>
        <th>RIWAYAT MEDIS</th>
        <th>FAKTOR RESIKO</th>
        <th>GEJALA</th>
        <th>RUMAH SAKIT</th>
        <th>TGL MASUK RS</th>
        <th>TGL KELUAR RS</th>
        <th>STATUS</th>
        <th>TEMPAT MENINGGAL</th>
        <th>PENYEBAB LANGSUNG</th>
        <th>PENYEBAB ANTARA</th>
        <th>PENYEBAB DASAR</th>
        <th>KONDISI BERKONTRIBUSI</th>
        <th>TGL VERIFIKASI</th>
        <th>TGL UPDATE</th>
        <th>TGL LAPOR SISTEM</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $key => $item)
        <tr>
            <td>{{ $item->num_id }}</td>
            <td>{{ "'".$item->nik}}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->kab_name }}</td>
            <td>{{ $item->kec_name ?? ' - ' }}</td>
            <td>{{ $item->kel_name ?? ' - ' }}</td>
            <td>{{ $item->address ?? '-' }}</td>
            <td>{{ $item->rt ?? '-' }}</td>
            <td>{{ $item->rw ?? '-'}}</td>
            <td>{{ $item->age }}</td>
            <td>{{ $item->sex=='L' ? 'Laki-Laki' : 'Perempuan' }}</td>
            <td>{{ $item->job_name }}</td>
            <td>{{ $item->job_place_name}}</td>
            <td>{{ $item->medical_history ?? ' - ' }}</td>
            <td>{{ $item->risk_factor ?? ' - ' }}</td>
            <td>{{ $item->symptom }}</td>
            <td>{{ $item->rumah_sakit_name }}</td>
            <td>{{ $item->tgl_lapor }}</td>
            <td>{{ $item->tgl_keluar }}</td>
            <td>{{ $item->status_name }}</td>
            <td>{{ $item->death_place_name ?? '-' }}</td>
            <td>{{ $item->direct_death_cause_name ?? '-' }}</td>
            <td>{{ $item->intermediate_death_cause_name ?? '-' }}</td>
            <td>{{ $item->basic_death_cause_name ?? '-' }}</td>
            <td>{{ $item->death_comorbid ?? '-' }}</td>
            <td>{{ $item->verify_at ?? '-' }}</td>
            <td>{{ $item->last_update}}</td>
            <td>{{ $item->patient_created_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
