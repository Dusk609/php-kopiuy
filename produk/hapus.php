<?php 
require '../proses/functions.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    if (hapus($id)) {
        echo "<script>
                alert('Produk berhasil dihapus!');
                window.location.href = '../index_admin.php';
              </script>";
    } else {
        echo "<script>
                alert('Produk gagal dihapus!');
                window.location.href = '../index_admin.php';
              </script>";
    }
} else {
    echo "<script>alert('Barang gagal di hapus');</script>";
}
?>
