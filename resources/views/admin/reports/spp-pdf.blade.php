<!DOCTYPE html>
<html>
<head>
    <title>Laporan Tagihan SPP</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 5px; }
    </style>
</head>
<body>
    <h2>Laporan Tagihan SPP</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bills as $b)
            <tr>
                <td>{{ $b->student->name }}</td>
                <td>{{ $b->month }}</td>
                <td>{{ $b->year }}</td>
                <td>Rp{{ number_format($b->amount, 0, ',', '.') }}</td>
                 <td>{{ $b->status === 'paid' ? 'Lunas' : 'Tidak Lunas' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
