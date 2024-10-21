<?php
require 'koneksi.php';
$email = $_POST["email"];
$name = $_POST["name"];
$institution = $_POST["institution"];
$country = $_POST["country"];
$address = $_POST["address"];

$query_sql = "INSERT INTO seminar (email, name, institution, country, address) 
            VALUES ('$email', '$name', '$institution', '$country', '$address')";

if (mysqli_query($conn, $query_sql)) {
    header("Location: index.html");
} else {
    echo "Pendaftaran Gagal : " . mysqli_error($conn);
}
