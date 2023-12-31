# Praktikum 8: PHP dan Database MySQL

### Membuat Database: Studi Kasus Data Barang
<table>
  <tr>
    <td>Nama Field</td>
    <td>Tipe Data</td>
    <td>Ukuran</td>
    <td>Keterangan</td>
  </tr>
  <tr>
    <td>id_Barang</td>
    <td>INT</td>
    <td>10</td>
    <td>PRIMARY KEY, AUTO_INCREMET</td>
  </tr>
  <tr>
    <td>Katergor</td>
    <td>VARCHAR</td>
    <td>30</td>
    <td></td>
  </tr>
  <tr>
    <td>Nama</td>
    <td>VARCHAR</td>
    <td>50</td>
    <td></td>
  </tr>
  <tr>
    <td>Gambar</td>
    <td>VARCHAR</td>
    <td>10</td>
    <td></td>
  </tr>
  <tr>
    <td>Harga_Beli</td>
    <td>INT</td>
    <td>8</td>
    <td></td>
  </tr>
  <tr>
    <td>Harga_Jual</td>
    <td>INT</td>
    <td>8</td>
    <td></td>
  </tr>
  <tr>
    <td>Stok</td>
    <td>INT</td>
    <td>4</td>
    <td></td>
  </tr>
</table>

### Membuat Database
```
CREATE DATABASE databarang;
```

### Membuat Tabel
```
CREATE TABLE data_barang (
id_barang int(10) auto_increment Primary Key,
kategori varchar(30),
nama varchar(30),
gambar varchar(100),
harga_beli decimal(10,0),
harga_jual decimal(10,0),
stok int(4)
);
```
![image](https://github.com/RadjaAzukio/lab8_php_database/assets/115551911/8bf4d272-4ab3-4513-b839-a19ed0b296f1)


### Memambahkan Data
```
INSERT INTO data_barang (kategori, nama, gambar, harga_beli, harga_jual, stok)
VALUES ('Elektronik', 'HP Samsung Android', 'hp_samsung.jpg', 2000000, 2400000, 5),
('Elektronik', 'HP Xiaomi Android', 'hp_xiaomi.jpg', 1000000, 1400000, 5),
('Elektronik', 'HP OPPO Android', 'hp_oppo.jpg', 1800000, 2300000, 5);
```
![image](https://github.com/RadjaAzukio/lab8_php_database/assets/115551911/f3e18d9c-32e8-41b0-ab40-eb11fa0eb85c)


### Membuat Program CRUD
Buat folder lab8_php_database pada root directory web server (d:\xampp\htdocs)

![image](https://github.com/RadjaAzukio/lab8_php_database/assets/115551911/10f8d19e-d68a-4ede-a7a7-70538e47c7b0)

Kemudian untuk mengakses direktory tersebut pada web server dengan mengakses URL:
http://localhost/lab8_php_database/

![a](https://github.com/RadjaAzukio/lab8_php_database/assets/115551911/e34738f6-154b-4a48-8059-91197c05543e)


### Membuat file koneksi database
Buat file baru dengan nama **koneksi.php**
```
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "latihan1";
$conn = mysqli_connect($host, $user, $pass, $db);
if ($conn == false)
{
echo "Koneksi ke server gagal.";
die();
} #else echo "Koneksi berhasil";
?>
````
Buka melalui browser untuk menguji koneksi database (untuk menyampaikan pesan koneksi berhasil, *uncomment* pada perintah ``echo "koneksi berhasi"``

![aa](https://github.com/RadjaAzukio/lab8_php_database/assets/115551911/530696d1-c679-43ba-9aa5-cdd550381cbe)


### Membuat file index untuk menampilkan data 
Buat file baru dengan nama **index.php**
```
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
```

![image](https://github.com/RadjaAzukio/lab8_php_database/assets/115551911/1f5b7eaa-444b-44a1-b6d3-b099d0f0a2ff)


### Menambah data (*Create*)
Buat file baru dengan nama **tambah.php**
```
<?php
error_reporting(E_ALL);
include_once 'koneksi.php';
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;
    if ($file_gambar['error'] == 0) {
        $filename = str_replace(' ', '_', $file_gambar['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;
        if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
            $gambar = 'gambar/' . $filename;
            ;
        }
    }
    $sql = 'INSERT INTO data_barang (nama, kategori,harga_jual, harga_beli,
stok, gambar) ';
    $sql .= "VALUE ('{$nama}', '{$kategori}','{$harga_jual}',
'{$harga_beli}', '{$stok}', '{$gambar}')";
    $result = mysqli_query($conn, $sql);
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="style_tambah.css" rel="stylesheet" type="text/css" />
    <title>Tambah Barang</title>
</head>

<body>
    <div class="container">
        <h1>Tambah Barang</h1>
        <div class="main">
            <form method="post" action="tambah.php" enctype="multipart/form-data">
                <div class="input">
                    <label>Nama Barang</label>
                    <input type="text" name="nama" />
                </div>
                <div class="input">
                    <label>Kategori</label>
                    <select name="kategori">
                        <option value="Komputer">Komputer</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Hand Phone">Hand Phone</option>
                    </select>
                </div>
                <div class="input">
                    <label>Harga Jual</label>
                    <input type="text" name="harga_jual" />
                </div>
                <div class="input">
                    <label>Harga Beli</label>
                    <input type="text" name="harga_beli" />
                </div>
                <div class="input">
                    <label>Stok</label>
                    <input type="text" name="stok" />
                </div>
                <div class="input">
                    <label>File Gambar</label>
                    <input type="file" name="file_gambar" />
                </div>
                <div class="submit">
                    <input type="submit" name="submit" value="Simpan" />
                </div>
            </form>
        </div>
    </div>
</body>

</html>
```

![image](https://github.com/RadjaAzukio/lab8_php_database/assets/115551911/79e5ebc6-c31d-4076-b0c8-f65476fa606e)


### Mengubah Data(*Update*)
Buat file baru dengan nama **ubah.php**
```
<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;

    if ($file_gambar['error'] == 0) {
        $filename = str_replace(' ', '_', $file_gambar['name']);
        $destination = dirname(__FILE__) . '/gambar/' . $filename;

        // Menambahkan ekstensi pengecekan gambar
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

        if (in_array($file_extension, $allowed_extensions) && move_uploaded_file($file_gambar['tmp_name'], $destination)) {
            $gambar = 'gambar/' . $filename;
        } else {
            die('Error: Gambar tidak valid. Hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan.');
        }
    }

    $sql = "UPDATE data_barang SET
            nama = '{$nama}',
            kategori = '{$kategori}',
            harga_jual = '{$harga_jual}',
            harga_beli = '{$harga_beli}',
            stok = '{$stok}' ";

    if (!empty($gambar)) {
        $sql .= ", gambar = '{$gambar}' ";
    }

    $sql .= "WHERE id_barang = '{$id}'";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die('Error: ' . mysqli_error($conn));
    }

    header('location: index.php');
}

$id = $_GET['id'];
$sql = "SELECT * FROM data_barang WHERE id_barang = '{$id}'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Error: Data tidak tersedia');
}

$data = mysqli_fetch_array($result);

function is_select($var, $val)
{
    return $var == $val ? 'selected="selected"' : '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="style_ubah.css" rel="stylesheet" type="text/css" />
    <title>Ubah Barang</title>
</head>

<body>
    <div class="container">
        <h1>Ubah Barang</h1>
        <div class="main">
            <form method="post" action="ubah.php" enctype="multipart/form-data">
                <div class="input">
                    <label>Nama Barang</label>
                    <input type="text" name="nama" value="<?php echo $data['nama']; ?>" />
                </div>
                <div class="input">
                    <label>Kategori</label>
                    <select name="kategori">
                        <option <?php echo is_select('Komputer', $data['kategori']); ?> value="Komputer">Komputer
                        </option>
                        <option <?php echo is_select('Elektronik', $data['kategori']); ?> value="Elektronik">Elektronik
                        </option>
                        <option <?php echo is_select('Hand Phone', $data['kategori']); ?> value="Hand Phone">Hand Phone
                        </option>
                    </select>
                </div>
                <div class="input">
                    <label>Harga Jual</label>
                    <input type="text" name="harga_jual" value="<?php echo $data['harga_jual']; ?>" />
                </div>
                <div class="input">
                    <label>Harga Beli</label>
                    <input type="text" name="harga_beli" value="<?php echo $data['harga_beli']; ?>" />
                </div>
                <div class="input">
                    <label>Stok</label>
                    <input type="text" name="stok" value="<?php echo $data['stok']; ?>" />
                </div>
                <div class="input">
                    <label>File Gambar</label>
                    <input type="file" name="file_gambar" />
                </div>
                <div class="submit">
                    <input type="hidden" name="id" value="<?php echo $data['id_barang']; ?>" />
                    <input type="submit" name="submit" value="Simpan" />
                </div>
            </form>
        </div>
    </div>
</body>

</html>
```

![image](https://github.com/RadjaAzukio/lab8_php_database/assets/115551911/21690020-bd0e-4e67-8863-31de2fd98a18)


### Menghapus Data(*Delete*)
Buat file baru dengan **hapus.php**
```
<?php
include_once 'koneksi.php';
$id = $_GET['id'];
$sql = "DELETE FROM data_barang WHERE id_barang = '{$id}'";
$result = mysqli_query($conn, $sql);
header('location: index.php');
?>
```
