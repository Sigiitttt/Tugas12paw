<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $pengarang = mysqli_real_escape_string($conn, $_POST['pengarang']);
    $penerbit = mysqli_real_escape_string($conn, $_POST['penerbit']);
    $tahun_terbit = mysqli_real_escape_string($conn, $_POST['tahun_terbit']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);

    $cover = '';
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
        $cover = time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $target = 'uploads/' . $cover;
        move_uploaded_file($_FILES['cover']['tmp_name'], $target);
    }

    $sql = "INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit, harga, genre, cover)
            VALUES ('$judul', '$pengarang', '$penerbit', '$tahun_terbit', '$harga', '$genre', '$cover')";
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<link rel="stylesheet" href="style.css">
<div class="container">
    <h2>Tambah Buku</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Judul</label>
        <input type="text" name="judul" required>

        <label>Pengarang</label>
        <input type="text" name="pengarang" required>

        <label>Penerbit</label>
        <input type="text" name="penerbit" required>

        <label>Tahun Terbit</label>
        <input type="number" name="tahun_terbit" required>

        <label>Harga</label>
        <input type="number" name="harga" step="0.01" required>

        <label>Genre</label>
        <select name="genre" required>
            <option value="">-- Pilih Genre --</option>
            <option value="Novel">Novel</option>
            <option value="Puisi">Puisi</option>
            <option value="Reflektif">Reflektif</option>
            <option value="Self-Improvement">Self-Improvement</option>
            <option value="Nonfiksi">Nonfiksi</option>
            <option value="Romansa">Romansa</option>
        </select>

        <label>Cover</label>
        <input type="file" name="cover" accept="image/*">

        <button type="submit" name="submit">Simpan</button>
        <a href="index.php" class="add-btn cancel">Batal</a>
    </form>
</div>
