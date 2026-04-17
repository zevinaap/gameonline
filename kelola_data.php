<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

if (isset($_GET['hapus_gejala'])) {
    mysqli_query($koneksi, "DELETE FROM gejala WHERE id_gejala='$_GET[hapus_gejala]'");
    header("Location: kelola_data.php");
}
if (isset($_GET['hapus_penyakit'])) {
    mysqli_query($koneksi, "DELETE FROM penyakit WHERE id_penyakit='$_GET[hapus_penyakit]'");
    header("Location: kelola_data.php");
}
if (isset($_GET['hapus_rule'])) {
    mysqli_query($koneksi, "DELETE FROM rules WHERE id_rule='$_GET[hapus_rule]'");
    header("Location: kelola_data.php");
}

//tambah data gejala, penyakit, rule baru
if (isset($_POST['simpan_gejala'])) {
    mysqli_query($koneksi, "INSERT INTO gejala VALUES ('$_POST[id_gejala]', '$_POST[nama_gejala]')");
}
if (isset($_POST['simpan_penyakit'])) {
    mysqli_query($koneksi, "INSERT INTO penyakit VALUES ('$_POST[id_penyakit]', '$_POST[nama_penyakit]', '$_POST[solusi]')");
}
if (isset($_POST['simpan_rule'])) {
    mysqli_query($koneksi, "INSERT INTO rules VALUES ('$_POST[id_rule]', '$_POST[id_penyakit]', '$_POST[rule_text]')");
}

//update nya
if (isset($_POST['update_gejala'])) {
    mysqli_query($koneksi, "UPDATE gejala SET nama_gejala='$_POST[nama_gejala]' WHERE id_gejala='$_POST[id_gejala]'");
    header("Location: kelola_data.php");
}
if (isset($_POST['update_penyakit'])) {
    mysqli_query($koneksi, "UPDATE penyakit SET nama_penyakit='$_POST[nama_penyakit]', solusi='$_POST[solusi]' WHERE id_penyakit='$_POST[id_penyakit]'");
    header("Location: kelola_data.php");
}
if (isset($_POST['update_rule'])) {
    mysqli_query($koneksi, "UPDATE rules SET id_penyakit='$_POST[id_penyakit]', rule_text='$_POST[rule_text]' WHERE id_rule='$_POST[id_rule]'");
    header("Location: kelola_data.php");
}


$edit_g = $edit_p = $edit_r = null;
if (isset($_GET['edit_gejala'])) $edit_g = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM gejala WHERE id_gejala='$_GET[edit_gejala]'"));
if (isset($_GET['edit_penyakit'])) $edit_p = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM penyakit WHERE id_penyakit='$_GET[edit_penyakit]'"));
if (isset($_GET['edit_rule'])) $edit_r = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM rules WHERE id_rule='$_GET[edit_rule]'"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Data Lengkap</title>
    <style>
        body { font-family: sans-serif; padding: 20px; line-height: 1.6; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn-edit { color: blue; margin-right: 10px; }
        .btn-hapus { color: red; }
        section { background: #fff; border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
    </style>
</head>
<body>

<h1>Panel CRUD Sistem Pakar</h1>
<p><a href="dbadmin.php">← Kembali ke Dashboard</a></p>

<section>
    <h2>1. Kelola Gejala</h2>
    <form method="post">
        <input type="text" name="id_gejala" placeholder="ID Gejala" value="<?= $edit_g['id_gejala'] ?? '' ?>" <?= isset($edit_g) ? 'readonly' : 'required' ?>>
        <input type="text" name="nama_gejala" placeholder="Nama Gejala" value="<?= $edit_g['nama_gejala'] ?? '' ?>" required>
        <?php if ($edit_g): ?>
            <button type="submit" name="update_gejala">Update Gejala</button>
            <a href="kelola_data.php">Batal</a>
        <?php else: ?>
            <button type="submit" name="simpan_gejala">Simpan Gejala</button>
        <?php endif; ?>
    </form>
    <table>
        <tr><th>ID</th><th>Nama Gejala</th><th>Aksi</th></tr>
        <?php $q = mysqli_query($koneksi, "SELECT * FROM gejala"); while($r = mysqli_fetch_assoc($q)): ?>
        <tr>
            <td><?= $r['id_gejala'] ?></td>
            <td><?= $r['nama_gejala'] ?></td>
            <td>
                <a class="btn-edit" href="?edit_gejala=<?= $r['id_gejala'] ?>">Edit</a>
                <a class="btn-hapus" href="?hapus_gejala=<?= $r['id_gejala'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</section>

<section>
    <h2>2. Kelola Penyakit</h2>
    <form method="post">
        <input type="text" name="id_penyakit" placeholder="ID Penyakit" value="<?= $edit_p['id_penyakit'] ?? '' ?>" <?= isset($edit_p) ? 'readonly' : 'required' ?>>
        <input type="text" name="nama_penyakit" placeholder="Nama Penyakit" value="<?= $edit_p['nama_penyakit'] ?? '' ?>" required>
        <input type="text" name="solusi" placeholder="Solusi" value="<?= $edit_p['solusi'] ?? '' ?>" required>
        <?php if ($edit_p): ?>
            <button type="submit" name="update_penyakit">Update Penyakit</button>
            <a href="kelola_data.php">Batal</a>
        <?php else: ?>
            <button type="submit" name="simpan_penyakit">Simpan Penyakit</button>
        <?php endif; ?>
    </form>
    <table>
        <tr><th>ID</th><th>Nama Penyakit</th><th>Solusi</th><th>Aksi</th></tr>
        <?php $q = mysqli_query($koneksi, "SELECT * FROM penyakit"); while($r = mysqli_fetch_assoc($q)): ?>
        <tr>
            <td><?= $r['id_penyakit'] ?></td>
            <td><?= $r['nama_penyakit'] ?></td>
            <td><?= $r['solusi'] ?></td>
            <td>
                <a class="btn-edit" href="?edit_penyakit=<?= $r['id_penyakit'] ?>">Edit</a>
                <a class="btn-hapus" href="?hapus_penyakit=<?= $r['id_penyakit'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</section>

<section>
    <h2>3. Kelola Rules</h2>
    <form method="post">
        <input type="text" name="id_rule" placeholder="ID Rule" value="<?= $edit_r['id_rule'] ?? '' ?>" <?= isset($edit_r) ? 'readonly' : 'required' ?>>
        <select name="id_penyakit" required>
            <?php 
            $qp = mysqli_query($koneksi, "SELECT * FROM penyakit");
            while($p = mysqli_fetch_assoc($qp)) {
                $sel = ($edit_r['id_penyakit'] == $p['id_penyakit']) ? 'selected' : '';
                echo "<option value='{$p['id_penyakit']}' $sel>{$p['nama_penyakit']}</option>";
            }
            ?>
        </select>
        <input type="text" name="rule_text" placeholder="Contoh: G01 AND G02" value="<?= $edit_r['rule_text'] ?? '' ?>" required>
        <?php if ($edit_r): ?>
            <button type="submit" name="update_rule">Update Rule</button>
            <a href="kelola_data.php">Batal</a>
        <?php else: ?>
            <button type="submit" name="simpan_rule">Simpan Rule</button>
        <?php endif; ?>
    </form>
    <table>
        <tr><th>ID Rule</th><th>Penyakit</th><th>Logika Rule</th><th>Aksi</th></tr>
        <?php $q = mysqli_query($koneksi, "SELECT rules.*, penyakit.nama_penyakit FROM rules JOIN penyakit ON rules.id_penyakit = penyakit.id_penyakit"); while($r = mysqli_fetch_assoc($q)): ?>
        <tr>
            <td><?= $r['id_rule'] ?></td>
            <td><?= $r['nama_penyakit'] ?></td>
            <td><?= $r['rule_text'] ?></td>
            <td>
                <a class="btn-edit" href="?edit_rule=<?= $r['id_rule'] ?>">Edit</a>
                <a class="btn-hapus" href="?hapus_rule=<?= $r['id_rule'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</section>

</body>
</html>