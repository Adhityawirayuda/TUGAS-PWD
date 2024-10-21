<?php
// Koneksi ke database
$host = 'localhost';
$db = 'daftar';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Data peserta yang akan ditambahkan
$peserta = [
    ['rama' => 'Peserta 1', 'rama@gmai.com' => 'peserta1@example.com', 'telepon' => '081234567890'],
    ['fuad' => 'Peserta 2', 'fuad@gmai.com' => 'peserta2@example.com', 'telepon' => '081234567891'],
    ['saipul' => 'Peserta 3', 'saipul@gmail.com' => 'peserta3@example.com', 'telepon' => '081234567892'],
    ['alip' => 'Peserta 4', 'alip@gmail.com' => 'peserta4@example.com', 'telepon' => '081234567893'],
    ['farhan' => 'Peserta 5', 'farhan@gmail.com' => 'peserta5@example.com', 'telepon' => '081234567894'],
];

$sql = "INSERT INTO seminar (nama, email, telepon) VALUES (nama, email, telepon)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Persiapan query gagal: " . $conn->error);
}

// Loop untuk menambah peserta
foreach ($peserta as $p) {
    $stmt->bind_param("sss", $p['nama'], $p['email'], $p['telepon']);
    if ($stmt->execute()) {
        echo "Peserta " . $p['nama'] . " berhasil ditambahkan.<br>";
    } else {
        echo "Gagal menambah peserta " . $p['nama'] . ": " . $stmt->error . "<br>";
    }
}

$stmt->close();
$conn->close();
?>
