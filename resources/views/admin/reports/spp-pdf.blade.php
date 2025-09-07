<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Tagihan SPP</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Laporan Tagihan SPP</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Siswa</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Jatuh Tempo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bills as $bill)
                <tr>
                    <td>{{ $bill->id }}</td>
                    <td>{{ $bill->student->name ?? '-' }}</td>
                    <td>{{ $bill->month }}</td>
                    <td>{{ $bill->year }}</td>
                    <td>{{ number_format($bill->amount, 0, ',', '.') }}</td>
                    <td>{{ $bill->status === 'paid' ? 'Lunas' : 'Tidak Lunas' }}</td>
                    <td>{{ $bill->due_date ? $bill->due_date->format('d-m-Y') : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

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
