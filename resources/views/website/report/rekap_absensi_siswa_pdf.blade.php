<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Absensi Siswa</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 8px; }
        .school-title { font-size: 24px; font-weight: bold; margin-bottom: 8px; }
        .school-info { font-size: 13px; margin-bottom: 2px; }
        hr { margin: 10px 0 18px 0; }
        .filter-info { margin-bottom: 15px; font-size: 13px; }
        .rekap-title { text-align: center; margin: 10px 0 2px 0; font-size: 18px; font-weight: bold; }
        .rekap-date { text-align: center; margin-bottom: 14px; font-size: 14px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #222; padding: 6px 8px; text-align: center; font-size: 13px; }
        th { background: #ffc107; color: #222; font-size: 13px; }
        td { background: #fff; color: #222; }
        .left { text-align: left; }
    </style>
</head>
<body>
    <div class="header">
        <div class="school-title">SEKOLAH PRESTASI PRIMA</div>
        <div class="school-info">Jl. Hankam Raya No. 89 Cilangkap, KOTA JAKARTA TIMUR</div>
        <div class="school-info">No Telp: 0 Email: humas@prestasi prima.sch.id</div>
    </div>
    <hr>
    <div class="filter-info">
        Kelas : {{ $kelasNama ?? '-' }}
    </div>
    <div class="rekap-title">Rekap Absensi Siswa</div>
    <div class="rekap-date">
        Tanggal : {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }}
        -
        {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}
    </div>
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>NIS</th>
                <th class="left">Nama</th>
                <th>Kelas</th>
                <th>Masuk</th>
                <th>Telat</th>
                <th>Sakit</th>
                <th>Ijin</th>
                <th>Alfa</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekap as $i => $row)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $row['nis'] }}</td>
                <td class="left">{{ $row['nama'] }}</td>
                <td>{{ $row['kelas'] }}</td>
                <td>{{ $row['masuk'] }}</td>
                <td>{{ $row['telat'] }}</td>
                <td>{{ $row['sakit'] }}</td>
                <td>{{ $row['ijin'] }}</td>
                <td>{{ $row['alfa'] }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="9">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>