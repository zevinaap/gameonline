<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Dashboard ADmin</title>
        <style>
            body {
                font-family: Arial;
                background: #f2f2f2;
            }
            .container {
                width: 400px;
                margin: 80px auto;
                background: white;
                padding: 20px;
                border-radius: 5px;
            }
            h2 {
                text-align: center;
            }
            ul {
                padding: 0;
            }
            li {
                list-style: none;
                margin-top: 10px;
            }
            a {
                display: block;
                padding: 10px;
                background: #007bff;
                color: white;
                text-decoration: none;
                text-align: center;
                border-radius: 4px;
            }
            a:hover {
                background: #0056b3;
            }
            hr {
                margin: 15px 0;
            }
            </style>
</head>
<body>
    <h2>Dashboard Admin</h2>
    <p>Login sebagai: <b>
        <?php
        echo $_SESSION['admin'];
        ?>
        </b></p>
        <hr>
        <ul><li>
            <a href="kelola_data.php">Kelola Data (gejala,penyakit,rules)</a>
</li>
</ul>
</body>
</html>