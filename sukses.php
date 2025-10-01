<?php
session_start();
$data = $_SESSION['checkout_success'] ?? null;
if (!$data) {
  header("Location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pemesanan Sukses</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<?php include 'navbar.php'; ?>

<div class="container mt-4">
  <div class="alert alert-success shadow-sm">
    <h4>Pemesanan Berhasil 🎉</h4>
    <p>Terima kasih, <b><?= htmlspecialchars($data['nama']) ?></b>. Pesanan Anda sedang diproses.</p>
    <ul>
      <li>Alamat: <?= htmlspecialchars($data['alamat']) ?></li>
      <li>No. Telepon: <?= htmlspecialchars($data['telepon']) ?></li>
      <li>Metode Pembayaran: <?= htmlspecialchars($data['metode']) ?></li>
      <li>Total Bayar: Rp <?= number_format($data['total'], 0, ',', '.') ?></li>
    </ul>
  </div>
  <a href="index.php" class="btn btn-warning">Kembali ke Home</a>
</div>

</body>
</html>
