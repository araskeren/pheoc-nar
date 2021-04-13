<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>NAMA</th>
            <th>KABUPATEN</th>
            <th>KECAMATAN</th>
            <th>KELURAHAN</th>
            <th>ALAMAT</th>
            <th>UMUR</th>
            <th>JENIS KELAMIN</th>
            {{-- <th>NO. TELP</th> --}}
            <th>PEKERJAAN</th>
            <th>TEMPAT PEKERJAAN</th>
            {{-- <th>KONDISI UMUM</th> --}}
            {{-- <th>PERSINGGAHAN</th> --}}
            <th>RIWAYAT MEDIS</th>
            <th>FAKTOR RESIKO</th>
            <th>GEJALA</th>
            {{-- <th>TGL MULAI GEJALA</th> --}}
            <th>RUMAH SAKIT</th>
            {{-- <th>TGL MASUK RS</th> --}}
            <th>TGL KELUAR RS</th>
            <th>STATUS</th>
            <th>PENYEBAB DASAR</th>
            <th>PENYEBAB ANTARA</th>
            <th>PENYEBAB LANGSUNG</th>
            <th>COMORBID</th>
            <th>TEMPAT MENINGGAL</th>
            {{-- <th>JUMLAH KONTAK</th> --}}
            {{-- <th>KODE NASIONAL</th> --}}
            <th>TGL UPDATE</th>
            <th>TGL LAPOR SISTEM</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key => $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ "'".$item->nik}}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->kab_name }}</td>
                <td>{{ $item->kec_name ?? ' - ' }}</td>
                <td>{{ $item->kel_name ?? ' - ' }}</td>
                <td>{{ $item->address }}</td>
                <td>{{ $item->age }}</td>
                <td>{{ $item->sex=='L' ? 'laki-laki' : 'perempuan' }}</td>
                {{-- <td>{{ $item->phone_number }}</td> --}}
                <td>{{ $item->job_name }}</td>
                <td>{{ $item->job_place_name}}</td>
                {{-- <td>{{ $item->common_condition }}</td> --}}
                {{-- <td>{{ $item->travel_place ?? ' - ' }}</td> --}}
                <td>{{ $item->medical_history ?? ' - ' }}</td>
                <td>{{ $item->risk_factor ?? ' - ' }}</td>
                <td>{{ $item->symptom }}</td>
                {{-- <td>{{ $item->symptom_date }}</td> --}}
                <td>{{ $item->rumah_sakit_name }}</td>
                {{-- <td>{{ $item->tgl_masuk }}</td> --}}
                <td>{{ $item->tgl_keluar }}</td>
                <td>{{ $item->status_name }}</td>
                {{-- <td>{{ $item->contact_count }}</td> --}}
                {{-- <td>{{ $item->national_id}}</td> --}}
                <td>{{ $item->basic_death_cause_name}}</td>
                <td>{{ $item->intermediate_death_cause_name}}</td>
                <td>{{ $item->direct_death_cause_name}}</td>
                <td>{{ $item->death_comorbid}}</td>
                <td>{{ $item->death_place_name}}</td>
                <td>{{ $item->last_update}}</td>
                <td>{{ $item->patient_created_at}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
