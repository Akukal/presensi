<table>
  <tr>
    <th colspan="8" align="center">Laporan Presensi Siswa</th>
  </tr>
  <tr>
    <td>NIS</td>
    <td colspan="7">{{ $siswa->nis }}</td>
  </tr>
  <tr>
    <td>Nama</td>
    <td colspan="7">{{ $siswa->nama }}</td>
  </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td colspan="7">{{ $siswa->jenis_kelamin == 'L' ? 'Pria' : 'Wanita' }}</td>
  </tr>
  <tr>
    <td>Kelas</td>
    <td colspan="7">{{ $siswa->kelas->nama }}</td>
  </tr>
  <tr>
    <td>Nomor Orang Tua</td>
    <td colspan="7">{{ $siswa->nomor_orang_tua }}</td>
  </tr>
  <tr>
    <td colspan="8">&nbsp;</td>
  </tr>
  <tr>
    <th>No</th>
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
      <td>{{ $presence->tanggal }}</td>
      <td>{{ $presence->jam_masuk }}</td>
      <td>{{ $presence->jam_pulang }}</td>
      <td>{{ $presence->status }}</td>
      <td>{{ $presence->status_masuk }}</td>
      <td>{{ $presence->keterangan }}</td>
    </tr>
  @endforeach
</table>