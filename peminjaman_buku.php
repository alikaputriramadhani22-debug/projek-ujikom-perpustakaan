<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];

if (isset($_GET['id_buku'])) {
    $id_buku = mysqli_real_escape_string($conn, $_GET['id_buku']);
    $tgl_sekarang = date('Y-m-d');

    $query_buku = mysqli_query($conn, "SELECT judul, status FROM tabel_data_buku WHERE id = '$id_buku'");
    $data_buku = mysqli_fetch_assoc($query_buku);
    
    if ($data_buku) {
        $judul_buku = $data_buku['judul'];
        if ($data_buku['status'] == 'aktif') {
            $sql_pinjam = "INSERT INTO tabel_transaksi (id_customer, judul_buku, tanggal_peminjaman, status) 
                           VALUES ('$user', '$judul_buku', '$tgl_sekarang', 'Pending')";
            
            $simpan = mysqli_query($conn, $sql_pinjam);
            if ($simpan) {
                mysqli_query($conn, "UPDATE tabel_data_buku SET status = 'proses' WHERE id = '$id_buku'");
                echo "<script>alert('✅ Berhasil!'); window.location.href = 'peminjaman_buku.php';</script>";
                exit(); 
            }
        }
    }
}

// --- BAGIAN PENCARIAN (LOGIKA) ---
$keyword = "";
$query_sql = "SELECT * FROM tabel_data_buku"; // Query default

if (isset($_GET['cari'])) {
    $keyword = mysqli_real_escape_string($conn, $_GET['cari']);
    // Mencari berdasarkan judul atau pengarang
    $query_sql = "SELECT * FROM tabel_data_buku WHERE judul LIKE '%$keyword%' OR pengarang LIKE '%$keyword%'";
}

$query_sql .= " ORDER BY id DESC"; // Tambahkan urutan di akhir
$ambil_data = mysqli_query($conn, $query_sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku | Lib-System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=2000');
            background-size: cover; background-attachment: fixed; color: white; min-height: 100vh;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 15px; padding: 25px;
            margin-top: 30px;
        }
        .table { color: white; border-color: rgba(255,255,255,0.1); }
        .table thead { background: #f1c40f; color: black; }
        .btn-pinjam { background: #f1c40f; color: black; font-weight: bold; border: none; border-radius: 8px; }
        /* Style tambahan untuk input pencarian */
        .search-box {
            background: rgba(255, 255, 255, 0.2); border: 1px solid rgba(255,255,255,0.3);
            color: white; border-radius: 8px 0 0 8px;
        }
        .search-box:focus { background: rgba(255, 255, 255, 0.3); color: white; border-color: #f1c40f; box-shadow: none; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark py-3 shadow">
    <div class="container">
        <a class="navbar-brand fw-bold" href="dashboardcustomer.php"><i class="bi bi-arrow-left-circle me-2"></i> Dashboard</a>
        <span class="navbar-text">
            <i class="bi bi-person-circle me-1"></i> User: <strong><?= htmlspecialchars($user); ?></strong>
        </span>
    </div>
</nav>

<div class="container pb-5">
    <div class="glass-card shadow-lg">
        <h2 class="mb-4 text-warning fw-bold text-center">
            <i class="bi bi-book-half me-2"></i> KOLEKSI BUKU
        </h2>

        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <form action="" method="GET" class="input-group">
                    <input type="text" name="cari" class="form-control search-box" 
                           placeholder="Cari judul atau penulis..." 
                           value="<?= htmlspecialchars($keyword) ?>">
                    <button class="btn btn-warning fw-bold" type="submit">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>
                    <?php if($keyword != ""): ?>
                        <a href="peminjaman_buku.php" class="btn btn-danger">Reset</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($ambil_data) > 0) {
                        while ($row = mysqli_fetch_assoc($ambil_data)) :
                            $status = $row['status'];
                    ?>
                    <tr class="text-center">
                        <td><?= $row['id'] ?></td>
                        <td class="text-start fw-bold"><?= $row['judul'] ?></td>
                        <td><?= $row['pengarang'] ?></td>
                        <td>
                            <?php if($status == 'aktif') : ?>
                                <span class="badge bg-success">Tersedia</span>
                            <?php elseif($status == 'proses') : ?>
                                <span class="badge bg-warning text-dark">Pending</span>
                            <?php else : ?>
                                <span class="badge bg-danger">Dipinjam</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($status == 'aktif') : ?>
                                <a href="peminjaman_buku.php?id_buku=<?= $row['id'] ?>" 
                                   class="btn btn-sm btn-pinjam px-3" 
                                   onclick="return confirm('Pinjam buku: <?= $row['judul'] ?>?')">
                                   <i class="bi bi-plus-lg"></i> Pinjam
                                </a>
                            <?php else : ?>
                                <button class="btn btn-sm btn-secondary opacity-50 px-3" disabled>N/A</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php 
                        endwhile; 
                    } else {
                        echo "<tr><td colspan='5' class='text-center py-4'>Data tidak ditemukan.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>