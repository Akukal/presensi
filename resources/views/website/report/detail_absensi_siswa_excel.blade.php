<table>
    <tr>
        <td colspan="{{ 3 + count($dates) }}" align="center" style="font-weight:bold; font-size:16px;">Detail Absensi Siswa</td>
    </tr>
    <tr>
        <td colspan="{{ 3 + count($dates) }}" align="center">Bulan : {{ $bulan }}</td>
    </tr>
    <tr>
        <td>Kelas :</td>
        <td>{{ $kelasNama ?? 'Semua' }}</td>
    </tr>
    <tr></tr>
    <tr>
        <th>NIS</th>
        <th>Nama</th>
        <th>Kelas</th>
        @foreach($dates as $d)
            <th>{{ \Carbon\Carbon::parse($d)->format('j/n') }}</th>
        @endforeach
    </tr>
    @foreach($rekap as $row)
    <tr>
        <td>{{ $row['nis'] }}</td>
        <td>{{ $row['nama'] }}</td>
        <td>{{ $row['kelas'] }}</td>
        @foreach($dates as $d)
            <td>{{ $row['absensi'][$d] ?? '-' }}</td>
        @endforeach
    </tr>
    @endforeach
</table>