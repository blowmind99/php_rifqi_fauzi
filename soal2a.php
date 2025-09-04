<?php
// Koneksi DB
$host = "localhost";
$user = "root";  // default Laragon
$pass = "";
$db   = "testdb";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil keyword search (jika ada)
$search = isset($_GET['search']) ? $_GET['search'] : "";

// Query dasar
$sql = "SELECT h.hobi, COUNT(DISTINCT h.person_id) AS jumlah_person
        FROM hobi h";

// Jika ada search
if (!empty($search)) {
    $sql .= " WHERE h.hobi LIKE '%" . $conn->real_escape_string($search) . "%'";
}

$sql .= " GROUP BY h.hobi ORDER BY jumlah_person DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Hobi</title>
    <style>
        table { border-collapse: collapse; width: 50%; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        form { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h2>Laporan Jumlah Person per Hobi</h2>

    <!-- Form search -->
    <form method="get">
        <label>Cari hobi: </label>
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Search</button>
        <a href="soal2b.php">Reset</a>
    </form>

    <!-- Tabel hasil -->
    <table>
        <tr>
            <th>Hobi</th>
            <th>Jumlah Person</th>
        </tr>
        <?php if ($result->num_rows > 0) { ?>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['hobi']) ?></td>
                    <td><?= $row['jumlah_person'] ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr><td colspan="2">Tidak ada data</td></tr>
        <?php } ?>
    </table>
</body>
</html>
<?php $conn->close(); ?>
