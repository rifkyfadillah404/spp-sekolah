<!DOCTYPE html>
<html>
<head>
    <title>Laporan Siswa</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 5px; }
    </style>
</head>
<body>
    <h2>Laporan Daftar Siswa</h2>
    <table>
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Email</th>
                <th>Telepon</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $s)
            <tr>
                <td>{{ $s->nis }}</td>
                <td>{{ $s->name }}</td>
                <td>{{ $s->class }}</td>
                <td>{{ $s->user->email ?? '-' }}</td>
                <td>{{ $s->phone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
