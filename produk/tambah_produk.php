<?php

session_start();

require '../proses/functions.php';

if (isset($_POST["submit"])) {
    
    if (tambah($_POST) > 0 ) {
        echo "<script>alert('Barang berhasil di tambahkan');</script>";
    } else {
        echo "<script>alert('Barang gagal di tambahkan');</script>";
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TambahProduk</title>
    <link rel="stylesheet" href="../login/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head> 

<body>

    <div class="login-card-container">
        <div class="login-card">
            <div class="login-card-logo">
                <img src="coffee-beans.png" alt="logo">
            </div>
            <div class="login-card-header">
                <h1>Tambah Produk</h1>
            </div>
            <form class="login-card-form" action="" method="post">
                <!-- Nama -->
                <div class="form-item">
                    <span class="form-item-icon material-symbols-rounded">coffee</span>
                    <input type="text" placeholder="Nama" name="name" required autofocus>
                </div>
                <!-- Harga -->
                <div class="form-item">
                    <span class="form-item-icon material-symbols-rounded">payments</span>
                    <input type="text" placeholder="Harga" name="price" required autofocus>
                </div>
                <!--Gambar -->
                <div class="form-item">
                    <span class="form-item-icon material-symbols-rounded">image</span>
                    <input type="text" placeholder="Gambar" name="image" required autofocus>
                </div>
                <button type="submit" name="submit">Tambah</button>
            </form>
            <div class="back-dusk-station">
                Kembali ke <a href="../index_admin.php">Halaman Admin</a>
            </div>
        </div>
    </div>

</body>

</html>