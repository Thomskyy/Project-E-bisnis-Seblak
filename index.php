<?php
session_start();

// Inisialisasi keranjang
if (!isset($_SESSION['cart_items'])) {
  $_SESSION['cart_items'] = [];
}

// Tambah ke keranjang
if (isset($_POST['add_to_cart'])) {
  $itemName  = $_POST['item_name'] ?? null;
  $itemPrice = $_POST['item_price'] ?? null;

  if ($itemName !== null && $itemPrice !== null) {
    $item = [
      "name" => $itemName,
      "price" => (int)$itemPrice,
      "qty" => 1
    ];

    $found = false;
    foreach ($_SESSION['cart_items'] as &$cartItem) {
      if ($cartItem['name'] === $item['name']) {
        $cartItem['qty']++;
        $found = true;
        break;
      }
    }
    unset($cartItem);

    if (!$found) {
      $_SESSION['cart_items'][] = $item;
    }
  }
}

// Data produk
$produk = [
  [
    "name" => "Seblak Kangkung",
    "price" => 15000,
    "image" => "assets/seblak-kangkung.jpg"
  ],
 [
    "name" => "Seblak Kangkung",
    "price" => 15000,
    "image" => "assets/seblak-kangkung.jpg"
  ],
 [
    "name" => "Seblak Kangkung",
    "price" => 15000,
    "image" => "assets/seblak-kangkung.jpg"
  ],
  [
    "name" => "Seblak Seafood",
    "price" => 25000,
    "image" => "assets/img/seblak-seafood.jpg"
  ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Seblak Herta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<?php include 'navbar.php'; ?>

<div class="container mt-5">
  <h2 class="text-warning mb-4">Menu Seblak</h2>
  <div class="row g-4">

    <?php foreach ($produk as $menu): ?>
      <div class="col-md-4 col-sm-6">
        <div class="card bg-dark border-warning text-light h-100">
          <img src="<?= $menu['image'] ?>" class="card-img-top" alt="<?= $menu['name'] ?>">
          <div class="card-body text-center">
            <h5 class="card-title"><?= $menu['name'] ?></h5>
            <p class="card-text">Rp <?= number_format($menu['price'], 0, ',', '.') ?></p>

            <?php if (!isset($_SESSION['user'])): ?>
              <a href="login.php" class="btn btn-outline-warning">Login untuk Pesan</a>
            <?php else: ?>
              <form method="post" action="index.php">
                <input type="hidden" name="item_name" value="<?= $menu['name'] ?>">
                <input type="hidden" name="item_price" value="<?= $menu['price'] ?>">
                <button type="submit" name="add_to_cart" class="btn btn-warning">
                  Tambah ke Keranjang
                </button>
              </form>
            <?php endif; ?>

          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
</div>

</body>
</html>
