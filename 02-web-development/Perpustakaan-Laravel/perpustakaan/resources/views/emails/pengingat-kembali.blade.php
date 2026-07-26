<!DOCTYPE html>
<html>
<head>
    <title>Pengingat Pengembalian Buku</title>
</head>
<body>
    <h2>Halo, {{ $peminjaman->anggota->nama }}</h2>
    <p>Ini adalah pengingat untuk mengembalikan buku <strong>{{ $peminjaman->buku->judul }}</strong>.</p>
    <p>Tanggal kembali seharusnya: <strong>{{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d M Y') }}</strong>.</p>
    <p>Mohon segera kembalikan buku tersebut agar tidak terkena sanksi keterlambatan.</p>
    <br>
    <p>Terima kasih,</p>
    <p><strong>Perpustakaan SMP N 12 Yogyakarta</strong></p>
</body>
</html>
