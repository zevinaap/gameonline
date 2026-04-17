<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Identitas Pengguna | Sistem Pakar</title>

<style>
* {
    box-sizing: border-box;
    font-family: 'Segoe UI', Arial, sans-serif;
}
body {
    margin: 0;
    min-height: 100vh;
    background: linear-gradient(135deg, #3c5bb2, #6e97d8);
    display: flex;
    justify-content: center;
    align-items: center;
}

/* CONTAINER */
.container {
    background: rgba(255,255,255,0.92);
    padding: 35px;
    width: 100%;
    max-width: 420px;
    border-radius: 18px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.35);
}

/* TEXT */
h2 {
    text-align: center;
    margin-bottom: 10px;
}
.subtitle {
    text-align: center;
    font-size: 14px;
    color: #555;
    margin-bottom: 25px;
}

/* FORM */
.form-group {
    margin-bottom: 15px;
}
label {
    font-weight: bold;
    font-size: 14px;
    margin-bottom: 5px;
    display: block;
}
input, select {
    width: 100%;
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #ccc;
    font-size: 14px;
}
input:focus, select:focus {
    outline: none;
    border-color: #0984e3;
}

/* BUTTON */
button {
    width: 100%;
    padding: 12px;
    background: #0984e3;
    color: white;
    border: none;
    border-radius: 20px;
    font-size: 15px;
    font-weight: bold;
    cursor: pointer;
    margin-top: 10px;
}
button:hover {
    background: #0870c4;
}

/* BACK */
.back {
    display: block;
    text-align: center;
    margin-top: 15px;
    font-size: 13px;
    color: #555;
    text-decoration: none;
}
.back:hover {
    text-decoration: underline;
}
</style>
</head>

<body>

<div class="container">
    <h2>Data Diri</h2>
    <div class="subtitle">
        Silakan lengkapi identitas Anda sebelum memulai diagnosa
    </div>

    <form action="diagnosa.php" method="POST">
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="form-group">
            <label>Umur</label>
            <input type="number" name="umur" placeholder="Masukkan umur" min="5" required>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <button type="submit" name="lanjut">Lanjut ke Diagnosa</button>
    </form>

    <a href="index.php" class="back">← Kembali ke Beranda</a>
</div>

</body>
</html>
