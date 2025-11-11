<?php
include 'db.php';

// Pastikan parameter id dikirim
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Ambil data buku berdasarkan id
$sql = "SELECT * FROM buku WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<p style='color:red;'>Buku tidak ditemukan!</p>";
    exit;
}

$buku = mysqli_fetch_assoc($result);

// Hapus file cover jika ada
if (!empty($buku['cover']) && file_exists('uploads/' . $buku['cover'])) {
    unlink('uploads/' . $buku['cover']);
}

// Hapus data buku dari database
$deleteSql = "DELETE FROM buku WHERE id = $id";
if (mysqli_query($conn, $deleteSql)) {
    header("Location: index.php");
    exit;
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>
