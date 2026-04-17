<?php
session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
    header("Location: identitas.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sistem Pakar | Kecanduan Game Online</title>

<style>
* {
    box-sizing: border-box;
    font-family: 'Segoe UI', Arial, sans-serif;
}
body {
    margin: 0;
    background: linear-gradient(135deg, #3c5bb2, #6e97d8);
    color: #2d3436;
}

/* NAV */
.nav {
    position: fixed;
    top: 0;
    width: 100%;
    padding: 15px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(0,0,0,0.25);
    backdrop-filter: blur(5px);
    z-index: 100;
}
.nav h3 {
    color: #fff;
    margin: 0;
}
.nav a {
    color: #fff;
    text-decoration: none;
    font-size: 13px;
    background: rgba(255,255,255,0.2);
    padding: 6px 14px;
    border-radius: 14px;
}
.nav a:hover {
    background: rgba(255,255,255,0.35);
}

/* HERO */
.hero {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 120px 20px 60px;
}
.hero-box {
    max-width: 1000px;
    background: rgba(255,255,255,0.9);
    border-radius: 20px;
    padding: 50px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    box-shadow: 0 25px 50px rgba(0,0,0,0.35);
}

/* TEXT */
.hero-text h1 {
    font-size: 32px;
    margin-bottom: 15px;
}
.hero-text p {
    font-size: 15px;
    line-height: 1.7;
    margin-bottom: 25px;
}
.btn {
    display: inline-block;
    padding: 14px 30px;
    background: #0984e3;
    color: #fff;
    text-decoration: none;
    border-radius: 25px;
    font-weight: bold;
}
.btn:hover {
    background: #0870c4;
}

/* IMAGE */
.hero-img {
    display: flex;
    align-items: center;
    justify-content: center;
}
.hero-img img {
    width: 100%;
    max-width: 380px;
    border-radius: 18px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.25);
}

/* SECTION */
.section {
    padding: 60px 20px;
    background: #f5f7fa;
}
.section h2 {
    text-align: center;
    margin-bottom: 40px;
}
.features {
    max-width: 1000px;
    margin: auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
}
.card {
    background: #fff;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    text-align: center;
}
.card img {
    width: 80px;
    margin-bottom: 15px;
}

/* FOOTER */
footer {
    background: #2d3436;
    color: #ccc;
    text-align: center;
    padding: 20px;
    font-size: 13px;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .hero-box {
        grid-template-columns: 1fr;
        text-align: center;
    }
}
</style>
</head>

<body>

<div class="nav">
    <h3>Sistem Pakar</h3>
    <a href="login_admin.php">Login Admin</a>
</div>

<!-- HERO -->
<section class="hero">
    <div class="hero-box">
        <div class="hero-text">
            <h1>Diagnosa Kecanduan Game Online</h1>
            <p>
                Sistem pakar ini membantu Anda mengetahui tingkat kecanduan game online
                berdasarkan gejala yang dialami.  
                Hasil diagnosa dapat digunakan sebagai bahan evaluasi diri secara mandiri.
            </p>
            <a href="identitas.php" class="btn">Mulai Diagnosa</a>
        </div>

        <div class="hero-img">
            <!-- GANTI GAMBAR DI SINI -->
            <img src="addiction.png" alt="Ilustrasi Game Online">
        </div>
    </div>
</section>

<!-- MANFAAT -->
<section class="section">
    <h2>Manfaat Sistem</h2>
    <div class="features">
        <div class="card">
            <img src="cepat.png">
            <h4>Cepat & Mudah</h4>
            <p>Proses diagnosa dilakukan secara online tanpa perlu bertemu pakar.</p>
        </div>
        <div class="card">
            <img src="akurat.png">
            <h4>Akurat</h4>
            <p>Berdasarkan aturan dan pengetahuan dari pakar.</p>
        </div>
        <div class="card">
            <img src="edukatif.png">
            <h4>Edukatif</h4>
            <p>Membantu meningkatkan kesadaran terhadap dampak kecanduan game.</p>
        </div>
    </div>
</section>

<!-- ALUR -->
<section class="section">
    <h2>Alur Diagnosa</h2>
    <div class="features">
        <div class="card">
            <h4>1. Isi Data Diri</h4>
            <p>Masukkan identitas dasar sebelum diagnosa.</p>
        </div>
        <div class="card">
            <h4>2. Pilih Gejala</h4>
            <p>Pilih gejala yang sesuai dengan kondisi Anda.</p>
        </div>
        <div class="card">
            <h4>3. Hasil Diagnosa</h4>
            <p>Sistem menampilkan hasil dan rekomendasi.</p>
        </div>
    </div>
</section>

<footer>
    © <?= date('Y') ?> Sistem Pakar Diagnosa Kecanduan Game Online
</footer>

</body>
</html>
