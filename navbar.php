<?php
// Pastikan session aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hitung jumlah item di keranjang
$cart_count = 0;
if (isset($_SESSION['cart_items'])) {
    foreach ($_SESSION['cart_items'] as $c) {
        $cart_count += $c['qty'];
    }
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-warning">
  <div class="container">
    <a class="navbar-brand text-warning fw-bold" href="index.php">Seblak Herta Pocket's Dimension</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">

        <!-- Link ke Home -->
        <li class="nav-item me-3">
          <a class="nav-link text-warning" href="index.php">Home</a>
        </li>

        <li class="nav-item me-3">
          <a class="nav-link text-warning" href="index.php">Produk</a>
        </li>

        <!-- Link ke Checkout -->
        <li class="nav-item me-3">
          <a class="nav-link text-warning" href="checkout.php">Checkout</a>
        </li>

        <!-- Keranjang -->
        <li class="nav-item me-3">
          <a href="chart.php" class="btn btn-outline-warning position-relative">
            <i class="bi bi-cart"></i>
            <?php if ($cart_count > 0): ?>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                <?= $cart_count ?>
              </span>
            <?php endif; ?>
          </a>
        </li>

        <!-- Login / Logout -->
        <?php if (isset($_SESSION['user'])): ?>
          <li class="nav-item">
            <a href="logout.php" class="btn btn-warning">Logout</a>
          </li>
        <?php else: ?>
          <li class="nav-item">
            <a href="login.php" class="btn btn-warning">Login</a>
          </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>

<!-- Efek Hover Navbar -->
<style>
  /* Hover untuk link navbar */
  .navbar-dark .navbar-nav .nav-link {
    color: #ffc107; /* warna gold default */
    transition: color 0.3s, background-color 0.3s;
    border-radius: 5px;
    padding: 5px 10px;
  }

  .navbar-dark .navbar-nav .nav-link:hover {
    color: #000;               /* teks hitam */
    background-color: #ffc107; /* latar gold */
  }

  /* Hover untuk tombol Login/Logout */
  .navbar .btn-warning:hover {
    background-color: #e0a800; /* gold lebih gelap */
    color: #000000ff;
  }

  /* Hover untuk tombol keranjang */
  .btn-outline-warning:hover {
    background-color: #ffc107;
    color: #000;
  }
</style>
