<?php
session_start();
include 'koneksi.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($username != '' && $password != '') {
        $query = mysqli_query($koneksi,
        "SELECT * FROM admin
        WHERE username='$username' AND password='$password'"
        );
        if (mysqli_num_rows($query) == 1) {
            $_SESSION['admin'] = $username;
            header("Location: dbadmin.php");
            exit;
} else {
    $error = "Username atau Password salah!";
}
    }
}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Login Admin</title>
        <style>
            body {
                font-family: Arial;
                background: linear-gradient(135deg, #3c5bb2ff, #6e97d8ff);
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 0;
            }
            .container {
                background: rgba(164, 198, 241, 0.92);
                padding:32px;
                max-width: 500px;
                box-shadow: 0 15px 35px rgba(0,0,0,0.35);
                border-radius: 12px;
                backdrop-filter: blur(6px);
            }
            h1 {
                text-align: center;
                color: #171818ff;
                margin-bottom: 5px;
            }
            h2 {
                text-align: center;
                margin-bottom: 20px;
            }

            .subtitle {
                text-align: center;
                font-size: 14px;
                color: #575f62ff;
                margin-bottom: 20px;
            }
            .desc {
                text-align: center;
                font-size: 14px;
                color: #575f62ff;
                margin-bottom: 25px;
            }
            .hr {
                margin-bottom: 20px;
                border: 0;
                border-top: 1px solid #ddd;
            }
            .form-group {
                margin-bottom: 15px;
            }
            label {
                display: block;
                font-weight: bold;
                margin-bottom: 5px;
                color: #2d3436;
            }
            input[type="text"],
            input[type="number"],
            select {
                width: 100%;
                padding: 10px;
                box-sizing: border-box;
                border: 1px solid #ccc;
                border-radius: 5px;
                font-size: 14px;
            }
            button {
                width: 100%;
                padding: 12px;
                background-color: #0984e3;
                color: white;
                border: none;
                border-radius: 15px;
                font-size: 15px;
                cursor: pointer;
                margin-top: 10px;
            }
            button:hover {
                background-color: #0870c4;
            }
            .admin-link {
                position: fixed;
                top: 15px;
                right: 20px;
                font-size: 13px;
                color: white;
                text-decoration: none;
                background: rgba(0,0,0,0.25);
                padding: 6px 12px;
                border-radius: 12px;
            }
            .admin-link:hover {
                background: rgba(0,0,0,0.4);
            }
            </style>
</head><body>
    <div class="container">
    <h2>Login Admin</h2>
    <?php
    if (isset($error))
        echo "<p style='color:red'>$error</p>";
    ?>
    <form method="post">
        <label>Username</label>
        <br>
        <input type="text" name="username" required>
        <br><br>
        <label>Password</label>
        <br>
        <input type="password" name="password" required>
        <br><br>
        <button type="submit" name="login">Login</button>
</form>
</div>
</body>
</html>