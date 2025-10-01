<?php
session_start();

// Cek login
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}

// Cek keranjang
if (empty($_SESSION['cart_items'])) {
  die("Keranjang kosong, tidak bisa checkout.");
}

// Ambil data form
$nama       = $_POST['nama'] ?? '';
$alamat     = $_POST['alamat'] ?? '';
$nohp       = $_POST['nohp'] ?? '';
$pembayaran = $_POST['pembayaran'] ?? '';

if ($nama == '' || $alamat == '' || $nohp == '' || $pembayaran == '') {
  die("Semua kolom wajib diisi.");
}

// Simpan data (sementara ditampilkan saja, nanti bisa disimpan ke DB)
$total = 0;
foreach ($_SESSION['cart_items'] as $item) {
  $total += $item['price'] * $item['qty'];
}

// Setelah sukses, kosongkan keranjang
$_SESSION['cart_items'] = [];
$_SESSION['cart_count'] = 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pesanan Berhasil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
<div class="container mt-5 text-center">
  <h2 class="text-warning">Pesanan Berhasil!</h2>
  <p>Terima kasih, <strong><?= htmlspecialchars($nama) ?></strong>. Pesanan Anda akan segera diproses.</p>
  <p>Total Pembayaran: <span class="text-warning fw-bold">Rp <?= number_format($total, 0, ',', '.') ?></span></p>
  <p>Metode Pembayaran: <span class="text-light"><?= htmlspecialchars($pembayaran) ?></span></p>
  <a href="index.php" class="btn btn-warning mt-3">Kembali ke Menu</a>
</div>
</body>
</html>
