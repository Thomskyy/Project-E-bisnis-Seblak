<?php
session_start();

// Cek login
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}

// Cek keranjang
if (empty($_SESSION['cart_items'])) {
  echo "<div class='alert alert-warning text-center'>Keranjang kosong, silakan pilih produk dulu.</div>";
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Checkout - Seblak Herta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
<div class="container mt-5">
  <h2 class="text-warning mb-4">Checkout Pesanan</h2>

  <form action="proses_checkout.php" method="POST" class="bg-dark p-4 border border-warning rounded">
     <div class="row g-3">
    <!-- Nama -->
    <div class="col-12 col-md-6">
      <label class="form-label text-warning">Nama Lengkap</label>
      <input type="text" name="nama" class="form-control bg-dark text-light border-warning" placeholder="Masukkan nama Anda" required>
    </div>

    <!-- Alamat -->
    <div class="col-12">
      <label class="form-label text-warning">Alamat Lengkap</label>
      <textarea name="alamat" class="form-control bg-dark text-light border-warning" placeholder="Masukkan alamat pengiriman" required></textarea>
    </div>

    <!-- Nomor HP -->
   <div class="col-12 col-md-6">
      <label class="form-label text-warning">Nomor HP</label>
      <input type="text" name="nohp" class="form-control bg-dark text-light border-warning" placeholder="08xxxxxxxxxx" required>
    </div>

    <!-- Metode Pembayaran -->
    <div class="col-12 col-md-6">
      <label class="form-label text-warning">Metode Pembayaran</label>
      <select name="pembayaran" class="form-control bg-dark text-light border-warning" required>
        <option value="">-- Pilih Metode --</option>
        <option value="COD">Cash on Delivery (COD)</option>
        <option value="Transfer">Transfer Bank</option>
      </select>
    </div>

    <!-- Ringkasan Pesanan -->
    <h5 class="text-warning mt-4">Ringkasan Pesanan:</h5>
    <ul class="list-group mb-3">
      <?php 
      $total = 0;
      foreach ($_SESSION['cart_items'] as $item): 
        $subtotal = $item['price'] * $item['qty'];
        $total += $subtotal;
      ?>
      <li class="list-group-item bg-dark text-light d-flex justify-content-between border-warning">
        <?= $item['name'] ?> (x<?= $item['qty'] ?>)
        <span>Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
      </li>
      <?php endforeach; ?>
      <li class="list-group-item bg-dark text-warning d-flex justify-content-between border-warning fw-bold">
        Total <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
      </li>
    </ul>

    <div class="d-flex justify-content-between">
      <a href="index.php" class="btn btn-outline-warning">Kembali Belanja</a>
      <button type="submit" class="btn btn-warning">Proses Pesanan</button>
    </div>
  </form>
</div>
</body>
</html>
