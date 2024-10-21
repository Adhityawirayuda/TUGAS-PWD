<?php
include_once("koneksi.php");

// Menambahkan data baru
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $institution = $_POST['institution'];
    $country = $_POST['country'];
    $address = $_POST['address'];

    // Query untuk menambahkan data ke tabel seminar
    $sql = "INSERT INTO seminar (email, name, institution, country, address) VALUES ('$email', '$name', '$institution', '$country', '$address')";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Menghapus data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM seminar WHERE email=email";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Mengambil data dari database
$result = $conn->query("SELECT * FROM seminar");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Seminar Nasional</title>
</head>
<body>
    <h2>Daftar Seminar Nasional</h2>

    <form method="POST" action="">
        <input type="email" name="email" placeholder="email" required>
        <input type="text" name="name" placeholder="name" required>
        <input type="text" name="institution" placeholder="institution" required>
        <input type="text" name="country" placeholder="country" required>
        <input type="text" name="address" placeholder="address" required>
        <button type="submit" name="submit">Tambah</button>
    </form>

    <table border="1">
        <tr>
            <th>Email</th>
            <th>Name</th>
            <th>Institution</th>
            <th>Country</th>
            <th>Address</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['institution']; ?></td>
                <td><?php echo $row['country']; ?></td>
                <td><?php echo $row['address']; ?></td>
                <td>
                    <a href="edit.php?email=<?php echo $row['email']; ?>">Edit</a>
                    <a href="daftar.php?delete=<?php echo $row['email']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
