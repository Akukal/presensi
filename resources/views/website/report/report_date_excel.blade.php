<table>
  <tr>
    <th colspan="10" style="font-size:18px;">Laporan Absensi Siswa By Tanggal</th>
  </tr>
  <tr>
    <th colspan="10" style="font-size:14px;">Tanggal: {{ $date->format('d F Y') }}</th>
  </tr>
  <tr>
    <th>No</th>
    <th>NIS</th>
    <th>Nama</th>
    <th>Kelas</th>
    <th>Tanggal</th>
    <th>Absen Masuk</th>
    <th>Absen Pulang</th>
    <th>Status</th>
    <th>Status Masuk</th>
    <th>Keterangan</th>
  </tr>
  @foreach ($presences as $index => $presence)
    <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $presence->siswa->nis }}</td>
      <td>{{ $presence->siswa->nama }}</td>
      <td>{{ $presence->siswa->kelas->kelas ?? '-' }}</td>
      <td>{{ $presence->tanggal }}</td>
      <td>{{ $presence->jam_masuk }}</td>
      <td>{{ $presence->jam_pulang }}</td>
      <td>{{ $presence->status }}</td>
      <td>{{ $presence->status_masuk }}</td>
      <td>{{ $presence->keterangan }}</td>
    </tr>
  @endforeach
</table>