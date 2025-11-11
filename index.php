<?php
include 'db.php';

// Ambil nilai pencarian dan genre dari URL
$search = isset($_GET['search']) ? $_GET['search'] : '';
$genre = isset($_GET['genre']) ? $_GET['genre'] : '';

$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Buat kondisi WHERE dinamis
$where = "WHERE (judul LIKE '%$search%' OR pengarang LIKE '%$search%')";
if ($genre != '') {
    $where .= " AND genre = '$genre'";
}

// Hitung total data
$countSql = "SELECT COUNT(*) AS total FROM buku $where";
$countResult = mysqli_query($conn, $countSql);
$countRow = mysqli_fetch_assoc($countResult);
$total = $countRow['total'];
$pages = ceil($total / $limit);

// Query data buku dengan filter
$sql = "SELECT * FROM buku $where LIMIT $start, $limit";
$result = mysqli_query($conn, $sql);
?>

<link rel="stylesheet" href="style.css">

<body>
    <div class="container">
        <h1>📚 Daftar Buku</h1>

        <!-- Form Filter -->
        <form method="GET" class="filter-form">
            <input type="text" name="search" placeholder="Cari judul atau pengarang..." value="<?php echo $search; ?>">

            <select name="genre">
                <option value="">-- Semua Genre --</option>
                <option value="Novel" <?php if ($genre == 'Novel') echo 'selected'; ?>>Novel</option>
                <option value="Puisi" <?php if ($genre == 'Puisi') echo 'selected'; ?>>Puisi</option>
                <option value="Reflektif" <?php if ($genre == 'Reflektif') echo 'selected'; ?>>Reflektif</option>
                <option value="Self-Improvement" <?php if ($genre == 'Self-Improvement') echo 'selected'; ?>>Self-Improvement</option>
                <option value="Nonfiksi" <?php if ($genre == 'Nonfiksi') echo 'selected'; ?>>Nonfiksi</option>
                <option value="Romansa" <?php if ($genre == 'Romansa') echo 'selected'; ?>>Romansa</option>
            </select>

            <button type="submit">🔍 Cari</button>
        </form>

        <a href="add.php" class="add-btn">+ Tambah Buku</a>

        <table>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Harga</th>
                <th>Genre</th>
                <th>Cover</th>
                <th>Action</th>
            </tr>

            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php
                $no = $start + 1; // mulai dari nomor urut halaman sekarang
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>

                        <td><?php echo htmlspecialchars($row['judul']); ?></td>
                        <td><?php echo htmlspecialchars($row['pengarang']); ?></td>
                        <td><?php echo htmlspecialchars($row['penerbit']); ?></td>
                        <td><?php echo $row['tahun_terbit']; ?></td>
                        <td>Rp<?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td><?php echo htmlspecialchars($row['genre']); ?></td>
                        <td>
                            <?php if (!empty($row['cover'])) { ?>
                                <img src="uploads/<?php echo $row['cover']; ?>" width="60">
                            <?php } else { ?>
                                <span style="color:#888;">(Tidak ada)</span>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                            <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="9" style="text-align:center; color:#777;">Tidak ada data ditemukan</td>
                </tr>
            <?php } ?>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $pages; $i++) { ?>
                <a href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>&genre=<?php echo $genre; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                    <?php echo $i; ?>
                </a>
            <?php } ?>
        </div>
    </div>
</body>