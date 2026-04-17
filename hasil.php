<?php
session_start();
include 'koneksi.php';
//cek user untuk memilih gejala
if (!isset($_POST['gejala']) || empty($_POST['gejala'])) {
    die("<h3>Pilih minimal satu gejala untuk diagnosa. <a href='diagnosa.php'>Kembali</a></h3>");
}
$gejala_terpilih = $_POST['gejala'];
//forward chaning mengambil rules & penyakit 
$sql_rules = "SELECT r.id_penyakit, r.rule_text, p.nama_penyakit, p.solusi
FROM rules r JOIN penyakit p ON r.id_penyakit = p.id_penyakit";
$result_rules = $koneksi->query($sql_rules);
$hasil_diagnosa = [];
if ($result_rules === FALSE) {
    die("Error SQL: " . $koneksi->error . ". Pastikan nama kolom di tabel 'rules' sudah benar.");
}
if ($result_rules->num_rows > 0) {
    while ($rule = $result_rules->fetch_assoc()) {
        $rule_text = $rule['rule_text'];
        $syarat_gejala = [];
        if (strpos($rule_text, 'THEN') !== false) {
            $parts = explode('THEN', $rule_text);
            $gejala_part = trim($parts[1]); 
            $syarat_gejala_raw = str_replace('AND', ',', $gejala_part);
            $syarat_gejala = explode(',', $syarat_gejala_raw);
        } else {
             $syarat_gejala = [trim($rule_text)];
        }
        $syarat_gejala = array_map('trim', $syarat_gejala); 
        //pencocokan fakta dan rule
        $is_match = true;
        foreach ($syarat_gejala as $syarat) {
            if (!in_array($syarat, $gejala_terpilih)) {
                $is_match = false;
                break; 
            }
        }
        if ($is_match) {
            $hasil_diagnosa[] = [
                'id_penyakit' => $rule['id_penyakit'],
                'nama_penyakit' => $rule['nama_penyakit'],
                'solusi' => $rule['solusi']
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Diagnosa</title>
    <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #7186c1ff, #f7f8fbff);
            margin: 0;
            padding: 30px 0;
        }
        .container {
            background: rgba(164, 198, 241, 0.95);
            max-width: 900px;
            margin: auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.35);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }
        h1 {
            text-align: center;
            color: #000;
            margin-bottom: 8px; 
        }
        h3 {
            margin-top:25px;
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 12px; 
        }
        th { 
            background-color: #0984e3;
            color: white; 
        }
        .info {
            background: none;
            border: none;
            padding: 0;
            margin: 0 auto 25px auto;
            max-width: none;
            text-align: center;
            font-size: 14px;
        }

        button { 
            padding: 10px 15px; 
            background-color: #007bff; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
        }
        button:hover {
            background-color: #0870c4;
        }
        .btn-center {
            text-align: center;
            margin-top: 25px;
        }
    </style>
</head>
<body>

    <h1>Hasil Diagnosa</h1>
    
    <div class="info">
        Nama Pasien: <?php echo isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Tidak Diketahui'; ?><br>
        Umur: <?php echo isset($_SESSION['umur']) ? $_SESSION['umur'] . ' tahun' : ''; ?><br>
        Jenis Kelamin: <?php echo isset($_SESSION['jenis_kelamin']) ? $_SESSION['jenis_kelamin'] : ''; ?>
    </div>
    
    <h3>Fakta Awal (gejala yang anda pilih):</h3>
    <ul>
        <?php 
        foreach ($gejala_terpilih as $id) {
            $q = $koneksi->query("SELECT nama_gejala FROM gejala WHERE id_gejala = '$id'");
            $g = $q->fetch_assoc();
            echo "<li><strong>$id</strong> - " . (isset($g['nama_gejala']) ? $g['nama_gejala'] : 'Nama Gejala Tidak Ditemukan') . "</li>";
        }
        ?>
    </ul>
    <h3>Kesimpulan (Hasil Forward Chaining):</h3>
    <?php
    if (!empty($hasil_diagnosa)) {
        echo "<p>Berdasarkan gejala di atas, sistem menyimpulkan Anda mungkin mengalami:</p>";
        $unique_diagnosa = array_map("unserialize", array_unique(array_map("serialize", $hasil_diagnosa)));
        echo "<table>";
        echo "<tr><th>ID</th><th>Penyakit</th><th>Rekomendasi / Solusi</th></tr>";
        foreach ($unique_diagnosa as $penyakit) {
            echo "<tr>";
            echo "<td>" . $penyakit['id_penyakit'] . "</td>";
            echo "<td><strong>" . $penyakit['nama_penyakit'] . "</strong></td>";
            echo "<td>" . $penyakit['solusi'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>⚠️ Tidak ada penyakit yang teridentifikasi dari kombinasi gejala yang Anda pilih. Coba pilih kombinasi gejala lain atau periksa kembali aturan di tabel rules Anda.</p>";
    }
    ?>
    <br>
    <a href="diagnosa.php"><button>Diagnosa Ulang</button></a>
    
</body>
<?php
$koneksi->close();
?>