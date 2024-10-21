<?php
include_once("koneksi.php");

// Mendapatkan data berdasarkan id untuk diedit
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    $result = $conn->query("SELECT * FROM seminar WHERE email='$email'");

    // Memastikan data ditemukan
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan!";
        exit();
    }
}

// Memperbarui data
if (isset($_POST['update'])) {
    // Mengambil data dari form dan mengamankan input pengguna
    $email = $conn->real_escape_string($_POST['email']);
    $name = $conn->real_escape_string($_POST['name']);
    $institution = $conn->real_escape_string($_POST['institution']);
    $country = $conn->real_escape_string($_POST['country']);
    $address = $conn->real_escape_string($_POST['address']);

    // Query untuk memperbarui data di tabel seminar berdasarkan id
    $sql = "UPDATE seminar SET 
        email='$email', 
        name='$name', 
        institution='$institution', 
        country='$country', 
        address='$address' 
        WHERE email='$email'";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diperbarui!";
        header("Location: daftar.php"); // Redirect ke halaman index setelah update
        exit(); // Pastikan proses dihentikan setelah header redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
</head>
<body>
    <h2>Edit Data</h2>

    <form method="POST" action="">
        <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" placeholder="email" required>
        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" placeholder="name" required>
        <input type="text" name="institution" value="<?php echo htmlspecialchars($row['institution']); ?>" placeholder="institution" required>
        <input type="text" name="country" value="<?php echo htmlspecialchars($row['country']); ?>" placeholder="country" required>
        <input type="text" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" placeholder="address" required>
        <button type="submit" name="update">Perbarui</button>
    </form>

    <a href="index.php">Kembali ke Daftar</a>
</body>
</html>
