<?php
session_start();
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = [
      'id' => $user['id'],
      'nama' => $user['nama'],
      'email' => $user['email']
    ];
    header("Location: index.php");
    exit;
  } else {
    $error = "Email atau password salah!";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login - Seblak Herta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow-lg" style="width: 400px; border: 2px solid gold;">
    <div class="card-body bg-dark text-light">
      <h3 class="text-center text-warning mb-4">Login</h3>
      
      <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
      <?php endif; ?>
      <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
      <?php endif; ?>

      <form method="post">
        <div class="mb-3">
          <label class="form-label text-warning">Email</label>
          <input type="email" name="email" class="form-control bg-dark text-light border-warning" required>
        </div>
        <div class="mb-3">
          <label class="form-label text-warning">Password</label>
          <input type="password" name="password" class="form-control bg-dark text-light border-warning" required>
        </div>
        <button type="submit" class="btn btn-warning w-100">Login</button>
      </form>
      <p class="mt-3 text-center">Belum punya akun? <a href="register.php" class="text-warning">Daftar</a></p>
    </div>
  </div>
</div>

</body>
</html>
