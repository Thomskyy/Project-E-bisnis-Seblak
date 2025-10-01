<?php
session_start();
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $nama, $email, $password);

  if ($stmt->execute()) {
    $_SESSION['success'] = "Registrasi berhasil, silakan login.";
    header("Location: login.php");
    exit;
  } else {
    $error = "Email sudah digunakan.";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Register - Seblak Herta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow-lg" style="width: 400px; border: 2px solid gold;">
    <div class="card-body bg-dark text-light">
      <h3 class="text-center text-warning mb-4">Register</h3>

      <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
      <?php endif; ?>

      <form method="post">
        <div class="mb-3">
          <label class="form-label text-warning">Nama Lengkap</label>
          <input type="text" name="nama" class="form-control bg-dark text-light border-warning" required>
        </div>
        <div class="mb-3">
          <label class="form-label text-warning">Email</label>
          <input type="email" name="email" class="form-control bg-dark text-light border-warning" required>
        </div>
        <div class="mb-3">
          <label class="form-label text-warning">Password</label>
          <input type="password" name="password" class="form-control bg-dark text-light border-warning" required>
        </div>
        <button type="submit" class="btn btn-warning w-100">Daftar</button>
      </form>
      <p class="mt-3 text-center">Sudah punya akun? <a href="login.php" class="text-warning">Login</a></p>
    </div>
  </div>
</div>

</body>
</html>
