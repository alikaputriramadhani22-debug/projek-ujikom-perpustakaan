<?php
session_start();
include 'koneksi.php';

$pesan_alert = ""; // Variabel untuk menyimpan pesan

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM tabel_admin WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['user'] = $username;
        // Kita gunakan JavaScript untuk alert sukses lalu redirect
        $pesan_alert = "sukses";
        header("Location:dashboard.php");
    } else {
        // Kita gunakan JavaScript untuk alert gagal
        $pesan_alert = "gagal";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Lib-System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style tetap sama seperti kode sebelumnya */
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?q=80&w=2000');
            background-size: cover; background-position: center; height: 100vh;
            display: flex; align-items: center; justify-content: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2); padding: 40px; border-radius: 20px;
            width: 100%; max-width: 400px; box-shadow: 0 15px 35px rgba(0,0,0,0.5); color: white;
        }
        .form-control { background: rgba(255, 255, 255, 0.2); border: none; color: white; padding: 12px; }
        .form-control::placeholder { color: #ddd; }
        .btn-login { background: #f1c40f; color: black; font-weight: bold; padding: 12px; border-radius: 10px; }
    </style>
</head>
<body>

<div class="login-card text-center">
    <h2 class="fw-bold mb-4">Lib-System</h2>
    <p class="mb-4 opacity-75">Silakan masuk ke akun admin Anda</p>
    
    <form action="" method="POST">
        <div class="mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="mb-4">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" name="login" class="btn btn-login w-100 border-0">MASUK</button>
    </form>
</div>

<script>
<?php if ($pesan_alert == "sukses"): ?>
    alert("✅ Login Berhasil! Selamat Datang, <?= $_SESSION['user']; ?>.");
    window.location.href = "index.php";
<?php elseif ($pesan_alert == "gagal"): ?>
    alert("❌ Login Gagal! Username atau Password salah.");
<?php endif; ?>
</script>

</body>
</html>
