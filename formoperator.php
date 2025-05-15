<?php
session_start();
include 'connection.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $status = $_POST['status'];

    $query = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password' AND status='$status'";
    $result = mysqli_query($conn, $query);

    

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['status'] = $row['status'];
        header('Location: forminputdatasiswa.php');
        exit();
    }

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        padding: 20px;
    }

    section {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    span {
        text-align: center;
        display: block;
        font-size: 14px;
        margin-top: 4px;
    }

    .gambar {
        display: flex;
        justify-content: center;
        width: 400px;
        height: 200px;
        margin: 0 auto;
    }

    .gambar img {
        width: 100%;
        height: 100%;
        border-radius: 5px;
    }

    h1 {
        text-align: center;
        margin-top: 20px;
        font-size: 24px;
    }

    form {
        display: flex;
        flex-direction: column;
        margin-top: 20px;
        gap: 10px;
    }

    form input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .btn {
        background-color: #4c6faf; /* Green */
        border: none;
        color: white;
        padding: 14px 24px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
    }

    .button {
        background-color: #3cc05a; /* Green */
        border: none;
        color: white;
        padding: 12px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 8px auto;
        display: flex;
        justify-content: center;
        cursor: pointer;
        border-radius: 5px;
    }

    select {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

 
</style>
<body>
    <h3>Masuk Akun</h3>
    <section>
        <div class="gambar">
            <lottie-player src="login.json" background="transparent"  speed="1" loop autoplay></lottie-player>
        </div>
      <span>Mulai akses Akun Kamu</span>
      <h1 class="text-center">
        Login User
      </h1>

      <div>
        <form action="" method="POST">
            <input type="text" name="username" id="username" placeholder="Username" >
            <input type="password" name="password" id="password" placeholder="Password" >

            <select name="status">
               <option value="">Pilih Status</option>
               <option value="siswa">Siswa</option>
               <option value="guru">Guru</option>
           </select>

            <button type="submit" name="submit" class="btn">Masuk</button>
        </form>
      </div>

      <span>Apakah Sudah Membuat Akun User</span>

      <a href="daftaroperator.php" class="button">Buat Akun User</a>
    </section>
</body>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</html>