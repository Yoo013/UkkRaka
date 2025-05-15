<?php 
session_start();
include 'connection.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $status = $_POST['status'];
    
    if (isset($_FILES['foto'])) {
        $foto = $_FILES['foto']['name'];
        $tmp_name = $_FILES['foto']['tmp_name'];
        
        $upload_dir = "uploads/";
    
        
        $foto_extension = pathinfo($foto, PATHINFO_EXTENSION);
        $foto_name = uniqid() . '.' . $foto_extension;
        $file_path = $upload_dir . $foto_name;
        
        if (move_uploaded_file($tmp_name, $file_path)) {
            $query = "INSERT INTO tbl_user (username, password, status, foto) VALUES ('$username', '$password', '$status', '$foto_name')";
            $result = mysqli_query($conn, $query);
            
            if ($result) {
                $_SESSION['success'] = "Data berhasil ditambahkan";
                header('Location: formoperator.php');
                exit();
            } else {
                $_SESSION['error'] = "Data gagal ditambahkan ke database: " . mysqli_error($conn);
            }
        }
    }   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Operator</title>
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
        padding: 10px 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    span {
        text-align: center;
        display: block;
        font-size: 12px;
        margin-top: 20px;
    }

    .gambar {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100px;
        height: 200px;
        margin: 0 auto;
    }

    .gambar img {
        width: 100%;
        height: 100%;
        border-radius: 5px;
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
        background-color: #4CAF50; /* Green */
        margin-top: 10px;
        border: none;
        color: white;
        padding: 10px 16px;
    }

    select {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    /* From Uiverse.io by Yaya12085 */ 
    .container {
        height: 100px;
        width: 100%;
        border-radius: 10px;
        box-shadow: 4px 4px 30px rgba(0, 0, 0, .2);
        gap: 5px;
        background-color: rgba(0, 110, 255, 0.041);
    }

    .header {
        width: 100%;
        height: 100%;
        border: 2px dashed royalblue;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        cursor: pointer;
    }

    .header svg {
        height: 100px;
    }

    .header p {
        text-align: center;
        color: black;
    }

    .footer svg {
        height: 130%;
        fill: royalblue;
        background-color: rgba(70, 66, 66, 0.103);
        border-radius: 50%;
        padding: 2px;
        cursor: pointer;
        box-shadow: 0 2px 30px rgba(0, 0, 0, 0.205);
    }

    .footer p {
        flex: 1;
        text-align: center;
    }

    #file {
        display: none;
    }

    .button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 10px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
    }

    .error-message {
        color: red;
        margin-bottom: 10px;
    }

    .success-message {
        color: green;
        margin-bottom: 10px;
    }
</style>
<body>
    <h1>Pendaftaran Operator</h1>

    <section>
        <!-- Display error/success messages -->
        <?php if(isset($_SESSION['error'])): ?>
            <div class="error-message"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['success'])): ?>
            <div class="success-message"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <h2>Register User</h2>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Masukkan Username" required>
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Masukkan Password" required>
            
            <label for="foto">Foto</label>
            <div class="container"> 
                <div class="header" id="upload-label"> 
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarry" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> 
                    <path d="M7 10V9C7 6.23858 9.23858 4 12 4C14.7614 4 17 6.23858 17 9V10C19.2091 10 21 11.7909 21 14C21 15.4806 20.1956 16.8084 19 17.5M7 10C4.79086 10 3 11.7909 3 14C3 15.4806 3.8044 16.8084 5 17.5M7 10C7.43285 10 7.84965 10.0688 8.24006 10.1959M12 12V21M12 12L15 15M12 12L9 15" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg> 
                    <p>Browse File to upload!</p>
                </div> 
                <input id="file" type="file" name="foto" accept="image/*" required> 
            </div>
            
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="">Pilih Status</option>
                <option value="siswa">Siswa</option>
                <option value="guru">Guru</option>
            </select>
            
            <button type="submit" name="submit" class="button">Register</button>
        </form>
    </section>

    <script>
        const fileInput = document.getElementById('file');
        const uploadLabel = document.getElementById('upload-label');
        
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const fileName = this.files[0].name;
                // Remove all existing content from the label
                uploadLabel.innerHTML = '';
                // Add the file name
                const p = document.createElement('p');
                p.textContent = fileName;
                uploadLabel.appendChild(p);
            }
        });

        uploadLabel.addEventListener('click', function() {
            fileInput.click();
        });
    </script>
</body>
</html>