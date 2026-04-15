<?php
$host = 'localhost';
$db   = 'pbp2026';
$user = 'root';
$pass = '';

$dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// ==========================
// PROSES UPDATE
// ==========================
if (isset($_POST['update'])) {
    $id       = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $passwordHash = password_hash($password, PASSWORD_BCRYPT, ['cost' => 13]);

    $sql = "UPDATE user SET username = ?, password_hash = ?, updated_at = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $passwordHash, time(), $id]);

    echo "<p style='color:green;'>User berhasil diupdate!</p>";
}

// ==========================
// AMBIL DATA USER
// ==========================
$users = $pdo->query("SELECT * FROM user")->fetchAll();

// ==========================
// AMBIL DATA YANG DIEDIT
// ==========================
$editData = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
    $stmt->execute([$id]);
    $editData = $stmt->fetch();
}
?>

<h2>Data User</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Aksi</th>
    </tr>

    <?php foreach ($users as $u): ?>
    <tr>
        <td><?= $u['id'] ?></td>
        <td><?= $u['username'] ?></td>
        <td><?= $u['email'] ?></td>
        <td>
            <a href="?id=<?= $u['id'] ?>">Edit</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<hr>

<?php if ($editData): ?>
<h3>Edit User</h3>

<form method="POST">
    <input type="hidden" name="id" value="<?= $editData['id'] ?>">

    <label>Username:</label><br>
    <input type="text" name="username" value="<?= $editData['username'] ?>" required><br><br>

    <label>Password Baru:</label><br>
    <input type="text" name="password" required><br><br>

    <button type="submit" name="update">Update</button>
</form>
<?php endif; ?>