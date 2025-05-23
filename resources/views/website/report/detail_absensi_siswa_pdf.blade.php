<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Absensi Siswa</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 9px; }
        .header { text-align: center; margin-bottom: 8px; }
        .school-title { font-size: 16px; font-weight: bold; margin-bottom: 8px; }
        .school-info { font-size: 10px; margin-bottom: 2px; }
        hr { margin: 10px 0 18px 0; }
        .filter-info { margin-bottom: 10px; font-size: 10px; }
        .rekap-title { text-align: center; margin: 10px 0 2px 0; font-size: 13px; font-weight: bold; }
        .rekap-date { text-align: center; margin-bottom: 10px; font-size: 10px; }
        table { border-collapse: collapse; width: 100%; table-layout: fixed; }
        th, td { border: 1px solid #222; padding: 1.5px 2px; text-align: center; font-size: 8px; word-break: break-word; }
        th { background: #ffc107; color: #222; font-size: 8px; }
        .left { text-align: left; }
        .badge-warning { background: #ffc107; color: #222; padding: 1px 3px; border-radius: 2px; font-size: 8px;}
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
        Kelas : {{ $kelasNama ?? 'Semua' }}
    </div>
    <div class="rekap-title">Detail Absensi Siswa</div>
    <div class="rekap-date">
        Bulan : {{ $bulan }}
    </div>
    <table>
        <thead>
            <tr>
                <th style="width:18px;">NO</th>
                <th style="width:34px;">NIS</th>
                <th class="left" style="width:60px;">Nama</th>
                <th style="width:30px;">Kelas</th>
                @foreach($dates as $d)
                    <th style="width:16px;">{{ \Carbon\Carbon::parse($d)->format('j/n') }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse($rekap as $i => $row)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $row['nis'] }}</td>
                <td class="left">{{ $row['nama'] }}</td>
                <td>{{ $row['kelas'] }}</td>
                @foreach($dates as $d)
                    <td>
                        @php $status = $row['absensi'][$d] ?? '-'; @endphp
                        @if($status == 'telat')
                            <span class="badge-warning">telat</span>
                        @elseif($status == 'masuk')
                            <span style="color:green">masuk</span>
                        @elseif($status == 'sakit')
                            <span style="color:blue">sakit</span>
                        @elseif($status == 'izin')
                            <span style="color:#007bff">izin</span>
                        @elseif($status == 'alfa')
                            <span style="color:red">alfa</span>
                        @else
                            {{ $status }}
                        @endif
                    </td>
                @endforeach
            </tr>
            @empty
            <tr>
                <td colspan="{{ 4 + count($dates) }}">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>