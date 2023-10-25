<?php
require '../proses/functions.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $fetch_product = query("SELECT * FROM products WHERE id = $id")[0];
    
    if (empty($fetch_product)) {
        echo "<script>
            alert('Produk tidak ditemukan!');
            window.location.href = '../index_admin.php';
        </script>";
    }

    if (isset($_POST["submit"])) {
        $id = $_GET['id'];
        $name = $_POST["name"];
        $price = $_POST["price"];
        $image = $_POST["image"];

        // Perbarui data produk
        if (edit(['id' => $id, 'name' => $name, 'price' => $price, 'image' => $image])) {
            // Proses berhasil
            echo "<script>
                alert('Produk berhasil diperbarui!');
                window.location.href = '../index_admin.php';
            </script>";
        } else {
            // Proses gagal
            echo "<script>
                alert('Produk gagal diperbarui!');
                window.location.href = '../index_admin.php';
            </script>";
        }
    }
}

// Pastikan $fetch_product didefinisikan meskipun tidak ada data yang ditemukan.
if (!isset($fetch_product)) {
    $fetch_product = array("name" => "", "price" => "", "image" => "");
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
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
                <h1>Edit Produk</h1>
            </div>
            <form class="login-card-form" action="" method="post">
                <!-- Nama -->
                <div class="form-item">
                    <span class="form-item-icon material-symbols-rounded">coffee</span>
                    <input type="text" placeholder="Nama" name="name" autofocus value="<?= $fetch_product['name'] ?>">
                </div>
                <!-- Harga -->
                <div class="form-item">
                    <span class="form-item-icon material-symbols-rounded">payments</span>
                    <input type="text" placeholder="Harga" name="price" autofocus value="<?= $fetch_product['price'] ?>">
                </div>
                <!-- Gambar -->
                <div class="form-item">
                    <span class="form-item-icon material-symbols-rounded">image</span>
                    <input type="text" placeholder="Gambar" name="image" autofocus value="<?= $fetch_product['image'] ?>">
                </div>
                <button type="submit" name="submit">Edit</button>
            </form>

            <div class="back-dusk-station">
                Kembali ke <a href="../index_admin.php">Halaman Admin</a>
            </div>
        </div>
    </div>

</body>

</html>