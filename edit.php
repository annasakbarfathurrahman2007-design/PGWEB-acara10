
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan8a";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? $_POST['id'] ?? '';

if ($id == '' || !is_numeric($id)) {
    die("ID tidak valid. Silakan kembali ke index.php dan klik Edit.");
}

if (isset($_POST['submit'])) {
    $kecamatan = $_POST['kecamatan'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $luas = $_POST['luas'];
    $jumlah_penduduk = $_POST['jumlah_penduduk'];

    $sql = "UPDATE kecamatan SET
    Kecamatan='$kecamatan',
    longitude=$longitude,
    latitude=$latitude,
    luas=$luas,
    jumlah_penduduk=$jumlah_penduduk
    WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$sql = "SELECT * FROM kecamatan WHERE id=$id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Form Edit Kecamatan</title>
</head>

<body>

<h2>Form Edit Kecamatan</h2>

<form action="edit.php?id=<?php echo $id; ?>" method="post">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<label>Kecamatan:</label><br>
<input type="text" name="kecamatan" value="<?php echo $row['Kecamatan']; ?>"><br>

<label>Longitude:</label><br>
<input type="text" name="longitude" value="<?php echo $row['longitude']; ?>"><br>

<label>Latitude:</label><br>
<input type="text" name="latitude" value="<?php echo $row['latitude']; ?>"><br>

<label>Luas:</label><br>
<input type="text" name="luas" value="<?php echo $row['luas']; ?>"><br>

<label>Jumlah Penduduk:</label><br>
<input type="text" name="jumlah_penduduk" value="<?php echo $row['jumlah_penduduk']; ?>"><br><br>

<input type="submit" name="submit" value="Simpan">
<a href="index.php">Kembali</a>

</form>

</body>
</html>

<?php
} else {
    echo "Data tidak ditemukan";
}

$conn->close();
?>
    