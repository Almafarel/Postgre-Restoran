<?php
    // Konfigurasi koneksi PostgreSQL
    $host = 'localhost';
    $port = '5432';
    $dbname = 'phpdatabase_restoran';
    $user = 'postgres';
    $pass = 'azon701';

    // Membuat koneksi ke database
    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");
    if (!$conn) {
        die('Koneksi gagal: ' . pg_last_error());
    }

    // Mengatur encoding karakter ke UTF-8
    pg_set_client_encoding($conn, 'UTF8');

    // Query untuk menampilkan data dari tabel TB_Restoran
    $sql = 'SELECT
                "id_pelanggan" AS "ID_Pelanggan",
                "Nama",
                "No.HP",
                "Alamat",
                "Jenis Makanan",
                "Harga",
                "Rating"
            FROM "TB_Restoran"
            ORDER BY "id_pelanggan"';

    // Eksekusi query
    $result = pg_query($conn, $sql);
    if (!$result) {
        die('Query gagal: ' . pg_last_error($conn));
    }
?>

<!-- HTML Code -->
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
</head>
<body>
    <h1>Daftar Pelanggan Restoran</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>ID_Pelanggan</th>
            <th>Nama</th>
            <th>No.HP</th>
            <th>Alamat</th>
            <th>Jenis Makanan</th>
            <th>Harga</th>
            <th>Rating</th>

        </tr>
        <?php $i = 1; ?>
        <?php while ($row = pg_fetch_assoc($result)): ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= htmlspecialchars($row["ID_Pelanggan"], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?= htmlspecialchars($row["Nama"], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?= htmlspecialchars($row["No.HP"], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?= htmlspecialchars($row["Alamat"], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?= htmlspecialchars($row["Jenis Makanan"], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?= htmlspecialchars($row["Harga"], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?= htmlspecialchars($row["Rating"], ENT_QUOTES, 'UTF-8'); ?></td>

        </tr>
        <?php $i++; endwhile; ?>
    </table>
</body>
</html>
