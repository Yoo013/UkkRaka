<?php
session_start();
include 'connection.php';

$query = "SELECT * FROM tbl_guru";
$result = mysqli_query($conn, $query);
$siswa = mysqli_fetch_assoc($result);



if(isset($_POST['submit'])) {
    $nomor_tes = $_POST['nomor_tes'];
    $tanggal_tes = $_POST['tanggal_tes'];
    $kesehatan = $_POST['kesehatan'];
    $tekab = $_POST['tekab'];
    $jasmani = $_POST['jasmani'];
    $hasil = $_POST['hasil'];

   $query = " UPDATE tbl_guru SET nomor_tes='$nomor_tes', tanggal_tes='$tanggal_tes', tes_kesehatan='$kesehatan', tes_tekab='$tekab', tes_jasmani='$jasmani', hasil_tes='$hasil' WHERE nomor_tes='$nomor_tes'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Data berhasil disimpan');</script>";
        echo "<script>window.location.href = 'datates.php';</script>";
        exit();
    } else {
        echo "<script>alert('Data gagal disimpan');</script>";
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
        <h1>Input Data Tes</h1>

        <form class="form" action="" method="POST">
    <label for="nomor_tes">Nomor Tes</label>
    <input type="text" value="<?= $siswa['nomor_tes']; ?>" name="nomor_tes" readonly>

    <label for="tanggal_tes">Tanggal Tes</label>
    <input type="date" value="<?= $siswa['tanggal_tes']; ?>" name="tanggal_tes" required>

    <label for="">Tes Kesehatan</label>
    <select name="kesehatan" id="kesehatan">
        <option value="">-- Pilih--</option>
        <option value="lulus" <?= $siswa['tes_kesehatan'] == 'lulus' ? 'selected' : '' ?>>Lulus</option>
        <option value="tidak_lulus" <?= $siswa['tes_kesehatan'] == 'tidak_lulus' ? 'selected' : '' ?>>tidak_lulus</option>
    </select>

    <label for="">Tes Tekab</label>
    <select name="tekab" id="tekab">
        <option value="">-- Pilih--</option>
        <option value="lulus" <?= $siswa['tes_tekab'] == 'lulus' ? 'selected' : '' ?>>Lulus</option>
        <option value="tidak_lulus" <?= $siswa['tes_tekab'] == 'tidak_lulus' ? 'selected' : '' ?>>Tidak Lulus</option>
    </select>

    <label for="">Tes Jasmani</label>
    <select name="jasmani" id="jasmani">
        <option value="">-- Pilih--</option>
        <option value="lulus" <?= $siswa['tes_jasmani'] == 'lulus' ? 'selected' : '' ?>>Lulus</option>
        <option value="tidak_lulus" <?= $siswa['tes_jasmani'] == 'tidak_lulus' ? 'selected' : '' ?>>Tidak Lulus</option>
    </select>

    <label for="">Hasil Tes:</label>
    <input type="text" value="<?= $siswa['hasil_tes']; ?>" name="hasil" id="hasil" required>
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
        if (hasil.value === 'lulus') passedFields.push('hasil');

        if (passedFields.length > 2) {
            hasil.value = 'Diterima';
        } else if (passedFields.length === 2) {
            hasil.value = 'Diterima dengan Catatan';
        } else if (passedFields.length === 1) {
            hasil.value = 'Tidak Diterima';
        } else if (passedFields.length === 0) {
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