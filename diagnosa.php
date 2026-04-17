<?php
session_start();
include 'koneksi.php';
//menyimpan data pasien ke session
if (isset($_POST['lanjut'])) {
        $_SESSION['nama'] = $_POST['nama'];
    $_SESSION['umur'] = $_POST['umur'];
        $_SESSION['jenis_kelamin'] = $_POST['jenis_kelamin'];
} 
if (!isset($_SESSION['nama']) || empty($_SESSION['nama'])) {
    header("Location: index.php");
exit;
}
//ambil data gejala dari databse
$sql_gejala = "
SELECT *, 
CAST(SUBSTRING(id_gejala, 2) AS SIGNED) AS urutan_numerik
FROM gejala 
    ORDER BY urutan_numerik ASC
";
$result_gejala = $koneksi->query($sql_gejala);
?>

<!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Diagnosa Penyakit | Pilih Gejala</title>
        <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #6e97d8ff, #f7f8fcff);
            min-height: 100vh;
            margin: 0;
        }
        .gejala-item { 
            margin-bottom: 12px; 
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
            margin-top: 15px;
        }
        button:hover {
            background-color: #0870c4;
        }
                .container {
            background: rgba(164, 198, 241, 0.92);
            padding: 32px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 15px 35px rgba(0,0,0,0.35);
            border-radius: 12px;
            backdrop-filter: blur(6px);
        }
          h1 {
            text-align: center;
            color: black;
            margin-bottom: 5px;
        }
        .subtitle {
            text-align: center;
            font-size: 14px;
            color: #2f3233ff;
            margin-bottom: 20px;
        }
        label {
            font-size: 14px;
            color: black;
        }
        .info {
            background-color: #c7d2ccff;
            padding: 10px 15px;
            margin: 15px auto 25px auto; 
            border-radius: 6px;
            font-size: 16px;
            max-width: 400px;  
            text-align: center; 
        }
    </style>
</head>
<body>
    <h1>Sistem Pakar Diagnosa Kecanduan Game Online - Forward Chaining</h1>
    <div class="info">
        Data Pasien: <?php echo $_SESSION['nama']; ?> (<?php echo $_SESSION['umur']; ?> tahun, <?php echo $_SESSION['jenis_kelamin']; ?>)
    </div>
    <h3>Pilih Gejala yang Anda Rasakan:</h3>
    <hr>
    <form action="hasil.php" method="POST"> 
        
        <?php
        if ($result_gejala->num_rows > 0) {
            while($row = $result_gejala->fetch_assoc()) {
                ?>
                <div class="gejala-item">
                    <input type="checkbox" 
                           name="gejala[]" 
                           id="<?php echo $row['id_gejala']; ?>" 
                           value="<?php echo $row['id_gejala']; ?>">
                    
                    <label for="<?php echo $row['id_gejala']; ?>">
                        <strong><?php echo $row['id_gejala']; ?></strong> - <?php echo $row['nama_gejala']; ?>
                    </label>
                </div>
                <?php
            }
        } else {
            echo "<p>❌ Data gejala tidak ditemukan.</p>";
        }
        ?>
        <br>
        <button type="submit" name="diagnosa">➡️ Proses Diagnosa</button>
    </form>
</body>
<?php
$koneksi->close(); 
?>