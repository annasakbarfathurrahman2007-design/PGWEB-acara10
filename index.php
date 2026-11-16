
<!DOCTYPE html>
<html>
<head>
<title>Data Kecamatan</title>
</head>

<body>

<h2>Data Kecamatan</h2>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan8a";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM kecamatan";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='8'>";
    echo "<tr>
    <th>Kecamatan</th>
    <th>Longitude</th>
    <th>Latitude</th>
    <th>Luas</th>
    <th>Jumlah Penduduk</th>
    <th colspan='2'>AKSI</th>
    </tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['Kecamatan']."</td>";
        echo "<td>".$row['longitude']."</td>";
        echo "<td>".$row['latitude']."</td>";
        echo "<td>".$row['luas']."</td>";
        echo "<td>".$row['jumlah_penduduk']."</td>";

        echo "<td><a href='edit.php?id=".$row['id']."'>Edit</a></td>";

        echo "<td><a href='delete.php?id=".$row['id']."' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a></td>";

        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Data tidak ditemukan";
}

$conn->close();
?>

</body>
</html>
