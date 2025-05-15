<?php
session_start();
include 'connection.php';

$query = "SELECT nomor_tes FROM tbl_siswa";
$result = mysqli_query($conn, $query);

if(isset($_POST['submit'])) {
    $nomor_tes = $_POST['nomor_tes'];
    $tanggal_tes = $_POST['tanggal_tes'];
    $kesehatan = $_POST['kesehatan'];
    $tekab = $_POST['tekab'];
    $jasmani = $_POST['jasmani'];
    $hasil = $_POST['hasil'];

    $check_query = "SELECT nomor_tes FROM tbl_guru WHERE nomor_tes = '$nomor_tes'";
    $check_result = mysqli_query($conn, $check_query);

    if(mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Nomor tes sudah dipakai');</script>";
    } else {
        $insert_query = "INSERT INTO tbl_guru (nomor_tes, tanggal_tes, tes_kesehatan, tes_tekab, tes_jasmani, hasil_tes) 
                         VALUES ('$nomor_tes', '$tanggal_tes', '$kesehatan', '$tekab', '$jasmani', '$hasil')";
        $insert_result = mysqli_query($conn, $insert_query);
        
        if ($insert_result) {
            echo "<script>alert('Data berhasil disimpan');</script>";
            echo "<script>window.location.href = 'datates.php';</script>";
            exit();
        } else {
            echo "<script>alert('Data gagal disimpan: " . mysqli_error($conn) . "');</script>";
        }
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
        background-color: #4CAF50;
        /* Green */
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

    .section {
        display: flex;
        padding: 20px 50px 20px 50px;
        gap: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
        margin-top: 20px;
        gap: 10px;
    }

    input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .button {
        background-color: #4CAF50;
        /* Green */
        margin-top: 10px;
        border: none;
        color: white;
        padding: 10px 16px;
        text-align: center;
        text-decoration: none;
    }

    select {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
</style>

<body>
    <header>
        <img src="baner.jpg" alt="">
        <div class="kanan">
            <p>Selamat Datang, <?php echo $_SESSION['username']; ?></p>
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
        <h1>Input Data Tes</h1>

        <form class="form" action="" method="POST">
            <label for="nomor_tes">Nomor Tes</label>
            <select name="nomor_tes" id="nomor_tes" required>
                <option value="">-- Pilih--</option>
                <?php 
                if(mysqli_num_rows($result) > 0) {
                    mysqli_data_seek($result, 0);
                    while ($row = mysqli_fetch_assoc($result)) : 
                ?>
                    <option value="<?= $row['nomor_tes']; ?>"><?= $row['nomor_tes']; ?></option>
                <?php 
                    endwhile;
                } 
                ?>
            </select>
            <label for="tanggal_tes">Tanggal Tes</label>
            <input type="date" placeholder="Pilih Tanggal Tes" name="tanggal_tes" id="tanggal_tes" required>
            <label for="kesehatan">Tes Kesehatan</label>
            <select name="kesehatan" id="kesehatan" required>
                <option value="">-- Pilih--</option>
                <option value="lulus">Lulus</option>
                <option value="tidak_lulus">Tidak Lulus</option>
            </select>
            <label for="tekab">Tes Tekab</label>
            <select name="tekab" id="tekab" required>
                <option value="">-- Pilih--</option>
                <option value="lulus">Lulus</option>
                <option value="tidak_lulus">Tidak Lulus</option>
            </select>
            <label for="jasmani">Tes Jasmani</label>
            <select name="jasmani" id="jasmani" required>
                <option value="">-- Pilih--</option>
                <option value="lulus">Lulus</option>
                <option value="tidak_lulus">Tidak Lulus</option>
            </select>

            <label for="hasil">Hasil Tes:</label>
            <input type="text" readonly name="hasil" id="hasil" required>
            <button type="submit" name="submit" class="button">Simpan</button>
        </form>
    </section>
</body>

<script>
    const kesehatan = document.getElementById('kesehatan');
    const tekab = document.getElementById('tekab');
    const jasmani = document.getElementById('jasmani');
    const hasil = document.getElementById('hasil');

    function calculateResult() {
        const passedFields = [];
        
        if (kesehatan.value === 'lulus') passedFields.push('kesehatan');
        if (tekab.value === 'lulus') passedFields.push('tekab');
        if (jasmani.value === 'lulus') passedFields.push('jasmani');

        if (passedFields.length === 3) {
            hasil.value = 'Diterima';
        } else if (passedFields.length === 2) {
            hasil.value = 'Diterima dengan Catatan';
        } else if (passedFields.length <= 1) {
            hasil.value = 'Tidak Diterima';
        } else {
            hasil.value = 'Belum Diketahui';
        }
    }

    kesehatan.addEventListener('change', calculateResult);
    tekab.addEventListener('change', calculateResult);
    jasmani.addEventListener('change', calculateResult);
</script>

</html>