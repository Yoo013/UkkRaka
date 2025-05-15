<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['username'])) {
    header('Location: formoperator.php');
    exit();
}

$username = $_SESSION['username'];
$query_user = "SELECT foto FROM tbl_user WHERE username='$username'";
$result_user = mysqli_query($conn, $query_user);
$user_data = mysqli_fetch_assoc($result_user);
$profile_photo = $user_data['foto'];

if(isset($_GET['nis'])) {
    $nis = $_GET['nis'];
    $query = "DELETE FROM tbl_siswa WHERE nis='$nis'";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        echo "<script>alert('Data berhasil dihapus');</script>";
        echo "<script>window.location.href = 'dashboard.php';</script>";
        exit();
    } else {
        echo "<script>alert('Data gagal dihapus');</script>";
    }
}

$query = "SELECT nis, nomor_tes, tanggal_tes, bersedia_mengikutiTes FROM tbl_siswa";
$result = mysqli_query($conn, $query);
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
    img {
        width: 100px;
        height: 200px;
        border-radius: 5px;
    }

    header {
        display: flex;
        align-items: center;
        color: black;

    }

    .kanan {
        margin-left: 10px;
        display: flex;
        align-items: center;
    }

    .btn {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
    }
    .container {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 20px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table thead td {
        background-color: rgb(88, 88, 180);
        color: white;
    }
</style>
<body>
    <header>
            <img src="uploads/<?php echo $profile_photo; ?>" alt="Profile Photo">
       
        <div class="kanan">
            <p>Selamat Datang,<?php echo $_SESSION['username']; ?></p>
            |
            <br>
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </header>

    <div class="container">
       <?php if ($_SESSION['status'] == 'guru') : ?>
        <a class="btn" href="dashboard.php">Data Siswa</a>
        <?php endif; ?>
        <?php if ($_SESSION['status'] == 'guru') : ?>
        <a class="btn" href="inputdatates.php">Input Tes</a>
        <?php endif; ?>

        <?php if ($_SESSION['status'] == 'siswa') : ?>
        <a class="btn" href="dashboard.php">Hasil Data Form</a>
        <?php endif; ?>
        <?php if ($_SESSION['status'] == 'guru') : ?>
        <a class="btn" href="datates.php">Data Tes</a>
        <?php endif; ?>
        <?php if ($_SESSION['status'] == 'siswa') : ?>
        <a class="btn" href="forminputdatasiswa.php">Form Siswa Untuk Bersedia Mengikuti Tes/Tidak</a>
        <?php endif; ?>
    </div>

    <section>
        <h1>Daftar Pendaftar</h1>

        <table class="table" border="1" cellpadding="10" cellspacing="0">
            <thead>
                <td>Nis</td>
                <td>Nomor Tes</td>
                <td>Tanggal Tes</td>
                <td>Bersedia Mengikuti Tes</td>
                <?php if ($_SESSION['status'] == 'guru') : ?>
                <td>Action</td>
                <?php endif; ?>
            </thead>
            <tbody>
                <tr>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <td><?php echo $row['nis']; ?></td>
                        <td><?php echo $row['nomor_tes']; ?></td>
                        <td><?php echo $row['tanggal_tes']; ?></td>
                        <td><?php echo $row['bersedia_mengikutiTes']; ?></td>
                        <?php if ($_SESSION['status'] == 'guru') : ?>
                    <td><a href="?nis=<?php echo $row['nis']; ?>">Delete</a>
                    <a href="edit.php?nis=<?php echo $row['nis']; ?>">Edit</a>
                </td>
                <?php endif; ?>
                    </tr>
                    <?php endwhile; ?>
                </tr>
            </tbody>
        </table>
    </section>
</body>
</html>