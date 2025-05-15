<?php
session_start();

include 'connection.php';



if (!isset($_SESSION['username'])) {
  header('Location: formoperator.php');
  exit();
}

if (!isset($_SESSION['status'])) {
  header('Location: formoperator.php');
  exit();
}

$query = "SELECT * FROM tbl_user WHERE username='" . $_SESSION['username'] . "'";
$result = mysqli_query($conn, $query);

$query = "SELECT * FROM tbl_user";
$result2 = mysqli_query($conn, $query);

if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}

$username = $_SESSION['username'];
$query_user = "SELECT foto FROM tbl_user WHERE username='$username'";
$result_user = mysqli_query($conn, $query_user);
$user_data = mysqli_fetch_assoc($result_user);
$profile_photo = $user_data['foto'];


if (isset($_POST['submit'])) {
  $nis = $_POST['nis'];
  $nomor_tes = $_POST['nomor_tes'];
  $tanggal_tes = $_POST['tanggal_tes'];
  $bersedia = $_POST['bersedia_mengikutiTes'];

  $query = "INSERT INTO tbl_siswa (nis, nomor_tes, tanggal_tes, bersedia_mengikutiTes) VALUES ('$nis', '$nomor_tes', '$tanggal_tes', '$bersedia')";
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

    .form-card {
      display: flex;
      flex-direction: column;
      gap: 30px;
    }

    .form-card img {
      width: 300px;
      height: 300px;
    }

    .form-card label {
      font-weight: 700;
      font-size: 20px;
    }

    .isi-table {
      margin: 20px;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
      margin: auto;
    }
  </style>

</head>

<body>
  <div class="top-bar">
    <img src="uploads/<?php echo $profile_photo; ?>" alt="Banner" class="banner-img">
    <span class="welcome-text">Selamat Datang,<?php echo $username; ?> |</span>
    <a href="logout.php" class="logout-btn">Logout</a>
  </div>

  <nav>
    <button class="nav-btn">Data Tes</button>
  </nav>

  <h2>Data Siapa</h2>



  <?php if ($_SESSION['status'] == 'siswa') : ?>
    <div class="form-card">
      <?php if ($row = mysqli_fetch_assoc($result)) : ?>
        <div>
          <label for="">Username</label>
          <p><?php echo $row['username']; ?></p>
        </div>
        <div>

          <label for="">Password</label>
          <p><?php echo $row['password']; ?></p>
        </div>
        <div>

          <label for="">Foto</label>
          <img src="uploads/<?php echo $profile_photo; ?>" alt="Banner" class="banner-img">
        </div>
        <div>

          <label for="">Status</label>
          <p><?php echo $row['status']; ?></p>
        </div>

      <?php endif;

      ?>

    </div>
  <?php endif; ?>


  <?php if ($_SESSION['status'] == 'guru') : ?>
    <div class="isi-table">
       <table class="table" border="1" cellpadding="10" cellspacing="0">
        <thead>
          <tr>
            <td>Username</td>
            <td>Password</td>
            <td>Foto</td>
            <td>Status</td>
            <td>Aksi</td>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result2)) : ?>
            <tr>
              <td><?php echo $row['username']; ?></td>
              <td><?php echo $row['password']; ?></td>
              <td><img src="uploads/<?php echo $row['foto']; ?>" alt="User Photo" class="banner-img"></td>
              <td><?php echo $row['status']; ?></td>
              <td>
                <a href="editdatauser.php?username=<?php echo $row['username']; ?>">Edit</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</body>

</html>