<?php

require_once __DIR__ . "/database/koneksi.php";

echo "===============================\n";
echo "        DATA BUNGA             \n";
echo "===============================\n";

try {
    // Ambil semua data dari tabel bunga
    $stmt = $pdo->query("SELECT * FROM bunga");
    $bunga = $stmt->fetchAll();

    // Cek jika data kosong
    if (!$bunga) {
        echo "Data bunga masih kosong.\n";
        exit;
    }

    // Tampilkan data
    foreach ($bunga as $row) {
        echo "ID           : " . $row['id'] . "\n";
        echo "Nama Bunga   : " . $row['nama_bunga'] . "\n";
        echo "Warna        : " . $row['warna'] . "\n";
        echo "Harga        : Rp " . number_format($row['harga'], 0, ',', '.') . "\n";
        echo "Stok         : " . $row['stok'] . "\n";
        echo "-------------------------------\n";
    }

} catch (PDOException $e) {
    echo "Error Database: " . $e->getMessage();
}

?>