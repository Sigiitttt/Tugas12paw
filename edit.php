<?php
include 'db.php';

// Pastikan ada ID
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Ambil data buku yang akan diedit
$sql = "SELECT * FROM buku WHERE id = $id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
    echo "<p style='color:red;'>Buku tidak ditemukan!</p>";
    exit;
}
$buku = mysqli_fetch_assoc($result);

// Jika form disubmit
if (isset($_POST['submit'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $pengarang = mysqli_real_escape_string($conn, $_POST['pengarang']);
    $penerbit = mysqli_real_escape_string($conn, $_POST['penerbit']);
    $tahun_terbit = mysqli_real_escape_string($conn, $_POST['tahun_terbit']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);

    $cover = $buku['cover']; // cover lama

    // Jika ada cover baru diupload
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
        // Hapus cover lama kalau ada
        if (!empty($buku['cover']) && file_exists('uploads/' . $buku['cover'])) {
            unlink('uploads/' . $buku['cover']);
        }

        // Upload cover baru
        $ext = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
        $cover = time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $target = 'uploads/' . $cover;

        move_uploaded_file($_FILES['cover']['tmp_name'], $target);
    }

    // Update data buku
    $updateSql = "UPDATE buku SET 
                    judul = '$judul',
                    pengarang = '$pengarang',
                    penerbit = '$penerbit',
                    tahun_terbit = '$tahun_terbit',
                    harga = '$harga',
                    cover = '$cover'
                  WHERE id = $id";

    if (mysqli_query($conn, $updateSql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<link rel="stylesheet" href="style.css">
<div class="container">
    <h2>Edit Buku</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Judul</label>
        <input type="text" name="judul" value="<?php echo htmlspecialchars($buku['judul']); ?>" required>

        <label>Pengarang</label>
        <input type="text" name="pengarang" value="<?php echo htmlspecialchars($buku['pengarang']); ?>" required>

        <label>Penerbit</label>
        <input type="text" name="penerbit" value="<?php echo htmlspecialchars($buku['penerbit']); ?>" required>

        <label>Tahun Terbit</label>
        <input type="number" name="tahun_terbit" value="<?php echo htmlspecialchars($buku['tahun_terbit']); ?>" required>

        <label>Harga</label>
        <input type="number" name="harga" step="0.01" value="<?php echo htmlspecialchars($buku['harga']); ?>" required>

        <label>Cover Saat Ini</label><br>
        <?php if (!empty($buku['cover'])) { ?>
            <img src="uploads/<?php echo $buku['cover']; ?>" width="100" alt="Cover Buku"><br>
        <?php } ?>
        <label>Ganti Cover (opsional)</label>
        <input type="file" name="cover" accept="image/*">

        <button type="submit" name="submit">Update</button>
        <a href="index.php" class="add-btn cancel">Batal</a>
    </form>
</div>
