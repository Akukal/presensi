<table>
    <tr>
        <td></td>
        <td colspan="9" align="center" style="font-weight:bold; font-size:16px;">Rekap Absensi Siswa</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="9" align="center">Tanggal : {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td>Kelas :</td>
        <td>{{ $kelasNama ?? '-' }}</td>
    </tr>
    <tr></tr>
    <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Masuk</th>
        <th>Telat</th>
        <th>Sakit</th>
        <th>Ijin</th>
        <th>Alfa</th>
    </tr>
    @foreach($rekap as $i => $row)
    <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $row['nis'] }}</td>
        <td>{{ $row['nama'] }}</td>
        <td>{{ $row['kelas'] }}</td>
        <td>{{ $row['masuk'] }}</td>
        <td>{{ $row['telat'] }}</td>
        <td>{{ $row['sakit'] }}</td>
        <td>{{ $row['ijin'] }}</td>
        <td>{{ $row['alfa'] }}</td>
    </tr>
    @endforeach
</table>