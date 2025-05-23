<html>
  <head>
    <title>Laporan Presensi Siswa</title>
    <style>
      table { border-collapse: collapse; font-size:12px; font-family: Arial, sans-serif; }
      table td, table th { border:1px solid #000; padding:5px; }
      .title { text-align:center; }
      p { font-size:14px; }
    </style>
  </head>
  <body>
    <div class="title">
      <h2>SEKOLAH PRESTASI PRIMA</h2>
      <p>Jl. Hankam Raya No. 89 Cilangkap, KOTA JAKARTA TIMUR</p>
      <p>No Telp: 0 Email: humas@prestasiprima.sch.id</p>
    </div>
    <hr>
    <table>
      <tr>
        <td>NIS</td>
        <td>:</td>
        <td>{{ $siswa->nis }}</td>
      </tr>
      <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{ $siswa->nama }}</td>
      </tr>
      <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td>{{ $siswa->jenis_kelamin == 'L' ? 'Pria' : 'Wanita' }}</td>
      </tr>
      <tr>
        <td>Kelas</td>
        <td>:</td>
        <td>{{ $siswa->kelas->nama }}</td>
      </tr>
      <tr>
        <td>Nomor Orang Tua</td>
        <td>:</td>
        <td>{{ $siswa->nomor_orang_tua }}</td>
      </tr>
    </table>
    <div class="title">
      <h3>Laporan Presensi Siswa</h3>
      <p>Tanggal: {{ $startDate->format('d F Y') }} - {{ $endDate->format('d F Y') }}</p>
    </div>
    <table width="100%">
      <thead>
        <tr style="background-color:rgb(220,220,220);">
          <th>No</th>
          <th>Tanggal</th>
          <th>Absen Masuk</th>
          <th>Absen Pulang</th>
          <th>Status</th>
          <th>Status Masuk</th>
          <th>Keterangan</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($presences as $index => $presence)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $presence->tanggal }}</td>
            <td>{{ $presence->jam_masuk }}</td>
            <td>{{ $presence->jam_pulang }}</td>
            <td>{{ $presence->status }}</td>
            <td>{{ $presence->status_masuk }}</td>
            <td>{{ $presence->keterangan }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>