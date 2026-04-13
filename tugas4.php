<?php

require_once __DIR__ . "/database/koneksi.php";

echo "===============================\n";
echo "       UPDATE STOK BUNGA       \n";
echo "===============================\n";

// Input ID bunga yang ingin dicari
$id = readline("Masukkan ID bunga yang ingin diupdate: ");

try {
    // 1. Cek data bunga berdasarkan ID
    $check = $pdo->prepare("SELECT * FROM bunga WHERE id = :id");
    $check->execute([':id' => $id]);
    $bunga = $check->fetch();

    // Jika data tidak ditemukan
    if (!$bunga) {
        echo "Bunga dengan ID $id tidak ditemukan.\n";
        exit;
    }

    // Tampilkan info bunga yang ditemukan
    echo "Bunga ditemukan: " . $bunga['nama_bunga'] . " (" . $bunga['warna'] . ")\n";
    echo "Stok saat ini: " . $bunga['stok'] . "\n";

    // 2. Input stok baru
    $stokBaru = readline("Masukkan stok baru: ");

    // 3. Update stok ke database
    $stmt = $pdo->prepare("
        UPDATE bunga
        SET stok = :stok
        WHERE id = :id
    ");

    $stmt->execute([
        ':stok' => (int)$stokBaru,
        ':id'   => $id
    ]);

    echo "Sukses! Stok " . $bunga['nama_bunga'] . " berhasil diupdate.\n";

} catch (PDOException $e) {
    echo "Error Database: " . $e->getMessage();
}
?>