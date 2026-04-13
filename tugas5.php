<?php
require_once __DIR__ . "/database/koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Bunga</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: auto;
            background: white;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<h1> Data Bunga </h1>

<table>
    <tr>
        <th>ID</th>
        <th>Nama Bunga</th>
        <th>Warna</th>
        <th>Harga</th>
        <th>Stok</th>
    </tr>

    <?php
    try {
        $stmt = $pdo->query("SELECT * FROM bunga");
        $data = $stmt->fetchAll();

        if ($data) {
            foreach ($data as $row) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama_bunga']}</td>
                        <td>{$row['warna']}</td>
                        <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                        <td>{$row['stok']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Data masih kosong</td></tr>";
        }

    } catch (PDOException $e) {
        echo "<tr><td colspan='5'>Error: {$e->getMessage()}</td></tr>";
    }
    ?>

</table>

</body>
</html>