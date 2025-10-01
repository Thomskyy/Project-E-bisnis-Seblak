<?php
session_start();
$cart_items = $_SESSION['cart_items'] ?? [];

// Hapus 1 produk
if (isset($_POST['remove_item'])) {
  $removeName = $_POST['item_name'] ?? null;

  if ($removeName !== null && isset($_SESSION['cart_items'])) {
    foreach ($_SESSION['cart_items'] as $key => $item) {
      if ($item['name'] === $removeName) {
        // kurangi count sesuai jumlah qty item
        if (isset($_SESSION['cart_count'])) {
          $_SESSION['cart_count'] -= $item['qty'];
          if ($_SESSION['cart_count'] < 0) $_SESSION['cart_count'] = 0;
        }

        // hapus produk dari cart
        unset($_SESSION['cart_items'][$key]);
        $_SESSION['cart_items'] = array_values($_SESSION['cart_items']); // reindex
        break;
      }
    }
  }

  header("Location: chart.php");
  exit;
}

// Kosongkan semua produk
if (isset($_POST['clear_cart'])) {
  unset($_SESSION['cart_items']);
  $_SESSION['cart_count'] = 0;
  header("Location: chart.php");
  exit;
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Keranjang Belanja</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <?php include 'navbar.php'; ?>
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
  <h2 class="mb-4 text-warning">Keranjang Belanja</h2>

  <?php if (empty($cart_items)): ?>
    <div class="alert alert-warning">Keranjang masih kosong.</div>
  <?php else: ?>
    <table class="table table-dark table-bordered text-center align-middle">
      <thead>
        <tr>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Subtotal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $total = 0;
        foreach ($cart_items as $item):
          if (!isset($item['name'], $item['price'], $item['qty'])) continue;
          $subtotal = (int)$item['price'] * (int)$item['qty'];
          $total += $subtotal;
        ?>
        <tr>
          <td><?= htmlspecialchars($item['name']) ?></td>
          <td>Rp <?= number_format((int)$item['price'], 0, ',', '.') ?></td>
          <td><?= (int)$item['qty'] ?></td>
          <td>Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
          <td>
            <form method="post" action="chart.php" style="display:inline;">
              <input type="hidden" name="item_name" value="<?= htmlspecialchars($item['name']) ?>">
              <button type="submit" name="remove_item" class="btn btn-sm btn-danger">
                Hapus
              </button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot>
        <tr>
          <th colspan="4">Total</th>
          <th>Rp <?= number_format($total, 0, ',', '.') ?></th>
        </tr>
      </tfoot>
    </table>
  <?php endif; ?>

 <div class="d-flex justify-content-between mt-3">
  <!-- Tombol lanjut belanja di kiri -->
  <a href="index.php" class="btn btn-success">
    Lanjut Belanja
  </a>

  <!-- Group tombol di kanan -->
  <div>
    <form method="post" action="chart.php" class="d-inline">
      <button type="submit" name="clear_cart" class="btn btn-danger me-2">
        Kosongkan Keranjang
      </button>
    </form>
    <a href="checkout.php" class="btn btn-primary">
      Checkout
    </a>
  </div>
</div>

</div>


</body>
</html>
