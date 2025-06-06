<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Absensi Siswa - {{ $date->format('d F Y') }}</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 8px; }
        .school-title { font-size: 24px; font-weight: bold; margin-bottom: 8px; }
        .school-info { font-size: 13px; margin-bottom: 2px; }
        hr { margin: 10px 0 18px 0; }
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
        <div class="school-info">No Telp: 0 Email: humas@prestasiprima.sch.id</div>
    </div>
    <hr>
    <div class="rekap-title">Laporan Absensi Siswa</div>
    <div class="rekap-date">
        Tanggal: {{ $date->format('d F Y') }}
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th class="left">Nama</th>
                <th>Kelas</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Status</th>
                <th>Status Masuk</th>
                <th class="left">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($presences as $index => $presence)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $presence->siswa->nis }}</td>
                    <td class="left">{{ $presence->siswa->nama }}</td>
                    <td>{{ $presence->siswa->kelas->kelas ?? '-' }}</td>
                    <td>{{ $presence->jam_masuk ?? '-' }}</td>
                    <td>{{ $presence->jam_pulang ?? '-' }}</td>
                    <td>{{ $presence->status ?? '-' }}</td>
                    <td>{{ $presence->status_masuk ?? '-' }}</td>
                    <td class="left">{{ $presence->keterangan ?? '-' }}</td>
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
