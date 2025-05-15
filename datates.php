<?php

session_start();
include 'connection.php';

if(isset($_GET['nomor_tes'])) {
    $nomor_tes = $_GET['nomor_tes'];
    $query = "DELETE FROM tbl_guru WHERE nomor_tes='$nomor_tes'";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        echo "<script>alert('Data berhasil dihapus');</script>";
        echo "<script>window.location.href = 'datates.php';</script>";
        exit();
    } else {
        echo "<script>alert('Data gagal dihapus');</script>";
    }
}

$query = "SELECT * FROM tbl_guru ";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
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

    a {
        text-decoration: none;
    }

    .table thead td {
        background-color: rgb(88, 88, 180);
        color: white;
    }
</style>
<body>
    <header>
        <img src="baner.jpg" alt="">
        <div class="kanan">
            <p>Selamat Datang,<?php echo $_SESSION['username']; ?></p>
            |
            <a href="formoperator.html" class="btn">Logout</a>
        </div>
    </header>

    <div class="container">
        <a class="btn" href="dashboard.php">Data Siswa</a>
        <a class="btn" href="inputdatates.php">Input Tes</a>
        <a class="btn" href="datates.php">Data Tes</a>
    </div>

    <section>
        <h1>Daftar Hasil Tes</h1>

        <table class="table" border="1" cellpadding="10" cellspacing="0">
            <thead>
                <td>No Tes</td>
                <td>Tanggal Tes</td>
                <td>Kesehatan</td>
                <td>Tekab</td>
                <td>Jasmani</td>
                <td>Hasil</td>
                <?php if ($_SESSION['status'] == 'guru') : ?>
                <td>Action</td> 
                <?php endif; ?>
            </thead>
            <tbody>
                <tr>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <td><?php echo $row['nomor_tes']; ?></td>
                        <td><?php echo $row['tanggal_tes']; ?></td>
                        <td><?php echo $row['tes_kesehatan']; ?></td>
                        <td><?php echo $row['tes_tekab']; ?></td>
                        <td><?php echo $row['tes_jasmani']; ?></td>
                        <td><?php echo $row['hasil_tes']; ?></td>
                        <?php if ($_SESSION['status'] == 'guru') : ?>
                            <td><a href="editguru.php?nomor_tes=<?php echo $row['nomor_tes']; ?>">Edit</a>
                            <a href="?nomor_tes=<?php echo $row['nomor_tes']; ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
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