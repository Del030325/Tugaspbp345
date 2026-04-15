<?php
$host = 'localhost';
$db   = 'PBP2026';
$user = 'root';
$pass = '';

// ==========================
// KONFIGURASI DATABASE
// ==========================
$dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Koneksi DB gagal: " . $e->getMessage());
}

// ==========================
// DATA YANG AKAN DIUPDATE
// ==========================
// Misal kita ingin update user dari Fakultas Teknik
$targetUsername = 'user_fakultas_teknik'; 
$newEmail = 'teknik_update@uho.ac.id';
$newPlainPassword = 'password_baru_123';
$newPasswordHash = password_hash($newPlainPassword, PASSWORD_BCRYPT, ['cost' => 13]);

function update_user($username, $email, $passwordHash) {
    global $pdo;

    // Menyiapkan Query Update
    $sql = "UPDATE user 
            SET email = :email, 
                password_hash = :password_hash, 
                updated_at = :updated_at 
            WHERE username = :username";
    
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':username'      => $username,
            ':email'         => $email,
            ':password_hash' => $passwordHash,
            ':updated_at'    => time()
        ]);

        // Cek apakah ada baris yang berubah
        if ($stmt->rowCount() > 0) {
            echo "\n✅ Update Berhasil!\n";
            echo "Username : $username\n";
            echo "Email Baru: $email\n";
            echo "Pass Baru : $username" . " (Hashed)\n";
        } else {
            echo "\n⚠️ Update Gagal: Username '$username' tidak ditemukan.\n";
        }

    } catch (Exception $e) {
        die("Gagal update data: " . $e->getMessage());
    }
}

// Jalankan fungsi
update_user($targetUsername, $newEmail, $newPasswordHash);

?>