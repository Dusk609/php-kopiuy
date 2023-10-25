<?php

$conn = mysqli_connect("localhost", "root", "", "kopiuy");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// kerja signup
function signup($data)
{
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower($data["email"]);
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek ulang konfirmasi password
    if ($password !== $password2) {
        echo "<script>alert('Konfirmasi password salah');</script>";
        return false;
    }

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Username sudah terdaftar');</script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambah user baru ke db dengan peran "customer" sebagai default
    $level = "customer";
    mysqli_query($conn, "INSERT INTO users (username, email, password, level) VALUES ('$username', '$email', '$password', '$level')");
    return mysqli_affected_rows($conn);
}

function search($keyword)
{
    $query = "SELECT * FROM cart WHERE
                name LIKE '%$keyword%'  OR
                price LIKE '%$keyword%' OR
                quantity LIKE '%$keyword%'
    ";
    return query($query);
}

function tambah($data) {
    global $conn;
    $name = htmlspecialchars($data["name"]);
    $price = htmlspecialchars($data["price"]);
    $image = htmlspecialchars($data["image"]);

    $query = "INSERT INTO products VALUES ('', '$name', '$price', '$image')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id) {
    global $conn;
    
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            return true;
        }
    }
    
    return false;
}

function edit($data)
{
    global $conn;
    $id = $data['id'];
    $name = htmlspecialchars($data['name']);
    $price = htmlspecialchars($data['price']);
    $image = htmlspecialchars($data['image']);

    $query = "UPDATE `products` SET 
        `name`='$name',
        `price`='$price',
        `image`='$image'
        WHERE `id` = $id
    ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

