<?php
    include("koneksi.php");
    // Fungsi hapus data
    if (isset($_GET['action']) && $_GET['action'] == 'hapus' && isset($_GET['id_barang'])) {
        $id_barang_hapus = $_GET['id_barang'];

    // Lakukan proses hapus data di database
    $sql_hapus = "DELETE FROM data_barang WHERE id_barang = $id_barang_hapus";
    mysqli_query($conn, $sql_hapus);
}
    // query untuk menampilkan data
    $sql = 'SELECT * FROM data_barang';
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <title>Data Barang</title>
</head>
    <body>
        <div class="container">
        <h1>Data Barang</h1>
            <div class="main">
                <table>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga Jual</th>
                        <th>Harga Beli</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                <?php if($result): ?>
                <?php while($row = mysqli_fetch_array($result)): ?>
                    <tr>
                        <td>
                        <img src="gambar/<?= $row['gambar']; ?>" alt="<?= $row['nama']; ?>" style="width: 100px;">
                        </td>
                        <td><?= $row['nama'];?></td>
                        <td><?= $row['kategori'];?></td>
                        <td><?= $row['harga_beli'];?></td>
                        <td><?= $row['harga_jual'];?></td>
                        <td><?= $row['stok'];?></td>
                        <td><?= $row['id_barang'];?>
                            <a href="ubah.php?id=<?= $row['id_barang'];?>">Ubah</a>
                            <a href="?action=hapus&id_barang=<?= $row['id_barang']; ?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</a>  
                            <a href="tambah.php">Tambah</a>
                        </td>  
                    </tr>
                <?php endwhile; else: ?>
                    <tr>
                        <td colspan="7">Belum ada data</td>
                    </tr>
                <?php endif; ?>
                </table>
            </div>
        </div>
    </body>
</html>