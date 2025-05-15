
<?php
session_start();

include 'connection.php';

if (!isset($_SESSION['username'])) {
    header('Location: formoperator.php');
    exit();
}

$nis = isset($_GET['nis']) ? $_GET['nis'] : '';
$nomor_tes = isset($_GET['nomor_tes']) ? $_GET['nomor_tes'] : '';
$tanggal_tes = isset($_GET['tanggal_tes']) ? $_GET['tanggal_tes'] : '';
$bersedia = isset($_GET['bersedia_mengikutiTes']) ? $_GET['bersedia_mengikutiTes'] : '';

$query = "SELECT nis, nomor_tes, tanggal_tes, bersedia_mengikutiTes FROM tbl_siswa WHERE nis='$nis'";
$data = mysqli_query($conn, $query);
$siswa = mysqli_fetch_assoc($data);




  if(isset($_POST['submit'])) {
    $nomor_tes = $_POST['nomor_tes'];
    $tanggal_tes = $_POST['tanggal_tes'];
    $bersedia = $_POST['bersedia_mengikutiTes'];

    $query = "UPDATE tbl_siswa SET nomor_tes='$nomor_tes', tanggal_tes='$tanggal_tes', bersedia_mengikutiTes='$bersedia' WHERE nis='$nis'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Data berhasil disimpan');</script>";
        echo "<script>window.location.href = 'dashboard.php';</script>";
        exit();
    } else {
        echo "<script>alert('Data gagal disimpan');</script>";
    }

  }


?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Input Data Siswa</title>
  <link rel="stylesheet" href="form-style.css">
<style>
    body {
  font-family: Arial, sans-serif;
  background-color: #f7f7f7;
  margin: 0;
  padding: 0;
}

.top-bar {
  background-color: #f2f2f2;
  padding: 10px 20px;
  display: flex;
  align-items: center;
}

.banner-img {
  height: 40px;
  margin-right: 15px;
}

.welcome-text {
  font-size: 18px;
  font-weight: bold;
  margin-right: 10px;
}

.logout-btn {
  background-color: #99c2ff;
  border: none;
  padding: 5px 10px;
  color: white;
  border-radius: 5px;
  cursor: pointer;
}

.logout-btn:hover {
  background-color: #6699ff;
}

nav {
  padding: 10px 20px;
}

.nav-btn {
  padding: 5px 10px;
  font-size: 14px;
}

h2 {
  margin-top: 10px;
  text-align: center;
}

.form-card {
  background-color: white;
  width: 350px;
  margin: auto;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
}

form label {
  display: block;
  margin-top: 10px;
  font-weight: bold;
}

form input,
form select {
  width: 100%;
  padding: 8px;
  margin-top: 5px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 14px;
}

.submit-btn {
  background-color: #28a745;
  color: white;
  border: none;
  padding: 10px;
  font-size: 14px;
  border-radius: 6px;
  cursor: pointer;
  margin-top: 10px;
}

.submit-btn:hover {
  background-color: #218838;
}

</style>

</head>
<body>
  <div class="top-bar">
    <img src="matcha-logo.png" alt="Banner" class="banner-img">
    <span class="welcome-text">Selamat Datang, b |</span>
    <button class="logout-btn">Logout</button>
  </div>

  <nav>
    <button class="nav-btn">Data Tes</button>
  </nav>

  <h2>Form Input Data Siswa</h2>

  <div class="form-card">
    <form action="" method="POST">


      <label for="nomor_tes">Nomor Tes:</label>
      <input type="text" id="nomor_tes" value="<?= $siswa['nomor_tes']; ?>" name="nomor_tes" required>

      <label for="tanggal_tes">Tanggal Tes:</label>
      <input type="date" id="tanggal_tes" value="<?= $siswa['tanggal_tes']; ?>" name="tanggal_tes" required>

      <label for="bersedia">Bersedia Mengikuti Tes:</label>
      <select id="bersedia" name="bersedia_mengikutiTes" required>
  <option value="">-- Pilih --</option>
  <option value="bersedia" <?= $siswa['bersedia_mengikutiTes'] == 'bersedia' ? 'selected' : '' ?>>bersedia</option>
  <option value="tidak_bersedia" <?= $siswa['bersedia_mengikutiTes'] == 'tidak_bersedia' ? 'selected' : '' ?>>tidak bersedia</option>
</select>

      

      <button type="submit" name="submit" class="submit-btn">Simpan Data</button>
    </form>
  </div>
</body>
</html>