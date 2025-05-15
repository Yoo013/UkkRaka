<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['username'])) {
    header('Location: formoperator.php');
    exit();
}

$username = isset($_GET['username']) ? $_GET['username'] : '';

if ($username) {
    $query = "SELECT * FROM tbl_user WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        $id_user = $user_data['id_user'];
        $username = $user_data['username'];
        $password = $user_data['password'];
        $status = $user_data['status'];
        $current_foto = $user_data['foto'];
    } else {
        $_SESSION['error'] = "User not found";
        header('Location: forminputdatasiswa.php');
        exit();
    }
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $status = $_POST['status'];
    if ($_FILES['foto']['size'] > 0) {
        $foto = $_FILES['foto']['name'];
        $tmp_name = $_FILES['foto']['tmp_name'];
        
        $upload_dir = "uploads/";
        
        $foto_extension = pathinfo($foto, PATHINFO_EXTENSION);
        $foto_name = uniqid() . '.' . $foto_extension;
        $file_path = $upload_dir . $foto_name;
        
        if (move_uploaded_file($tmp_name, $file_path)) {
            // Update with new photo
            $query = "UPDATE tbl_user SET 
                    username = '$username', 
                    password = '$password', 
                    status = '$status', 
                    foto = '$foto_name' 
                    WHERE username = '$username'";
        } else {
            $_SESSION['error'] = "Failed to upload image";
        }
    } else {
        $query = "UPDATE tbl_user SET 
                id_user = '$id_user',
                username = '$username', 
                password = '$password', 
                status = '$status' 
                WHERE id_user = '$id_user'";
    }
    
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $_SESSION['success'] = "Data successfully updated";
        header('Location: forminputdatasiswa.php');
        exit();
    } else {
        $_SESSION['error'] = "Failed to update data: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }
        
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        form {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        
        button:hover {
            background-color: #45a049;
        }
        
        .current-image {
            margin: 10px 0;
        }
        
        .current-image img {
            max-width: 100px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h2>Edit User Data</h2>
    
    <?php if(isset($_SESSION['error'])): ?>
        <div style="color: red; text-align: center; margin-bottom: 15px;">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo $username; ?>" placeholder="Username">
        </div>
        
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo $password; ?>" placeholder="Password">
        </div>
        
        <div>
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="">Select Status</option>
                <option value="siswa" <?php echo ($status == 'siswa') ? 'selected' : ''; ?>>Siswa</option>
                <option value="guru" <?php echo ($status == 'guru') ? 'selected' : ''; ?>>Guru</option>
            </select>
        </div>
        
        <div>
            <label for="foto">Current Photo:</label>
            <div class="current-image">
                <?php if(isset($current_foto) && !empty($current_foto)): ?>
                    <img src="uploads/<?php echo $current_foto; ?>" alt="Current user photo">
                <?php else: ?>
                    <p>No photo available</p>
                <?php endif; ?>
            </div>
        </div>
        
        <div>
            <input type="file" name="foto" id="foto">
        </div>
        
        <div style="margin-top: 20px;">
            <button type="submit" name="submit" class="btn">Update Data</button>
            <a href="dashboard.php" style="margin-left: 10px; text-decoration: none;">Cancel</a>
        </div>
    </form>
</body>
</html>