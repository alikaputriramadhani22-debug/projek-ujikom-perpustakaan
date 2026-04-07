<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'customer') {
    header("Location: login.php");
    exit();
}

include 'koneksi.php';

$user_session = $_SESSION['user'];
$query_profil = mysqli_query($conn, "SELECT * FROM crud_anggota WHERE nama = '$user_session' OR no_anggota = '$user_session' LIMIT 1");
$data_mhs = mysqli_fetch_array($query_profil);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa | Lib-System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=2000');
            background-size: cover; background-attachment: fixed;
            font-family: 'Segoe UI', sans-serif; color: white; min-height: 100vh;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 20px;
            padding: 30px; transition: 0.3s;
        }
        .menu-card {
            cursor: pointer; text-decoration: none; color: white; display: block;
        }
        .menu-card:hover {
            background: rgba(241, 196, 15, 0.2); transform: translateY(-10px);
            border-color: #f1c40f; color: #f1c40f;
        }
        .icon-box {
            font-size: 3rem; margin-bottom: 15px; color: #f1c40f;
        }
        .navbar-custom {
            background: rgba(0, 0, 0, 0.5); backdrop-filter: blur(5px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .btn-logout {
            background: #e74c3c; color: white; border-radius: 10px; font-weight: bold;
        }
        .profile-info b { color: #f1c40f; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom py-3 mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3" href="#">Lib-System <span class="text-warning">Siswa</span></a>
        <div class="ms-auto">
            <span class="me-3">Halo, <strong><?= $user_session; ?></strong></span>
            <a href="logout.php" class="btn btn-logout px-4">KELUAR</a>
        </div>
    </div>
</nav>

<div class="container mt-4 pb-5">
    <div class="row mb-5">
        <div class="col-12 glass-card text-center">
            <h1 class="display-5 fw-bold">Selamat Datang di Perpustakaan</h1>
            <p class="lead opacity-75">Kelola aktivitas perpustakaanmu dengan mudah.</p>
        </div>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-md-4">
            <div class="glass-card menu-card text-center h-100" data-bs-toggle="modal" data-bs-target="#modalProfil">
                <div class="icon-box">
                    <i class="bi bi-person-badge"></i>
                </div>
                <h3>Data Anggota</h3>
                <p class="opacity-75">Lihat informasi kartu anggota dan status akunmu.</p>
            </div>
        </div>

        <div class="col-md-4">
            <a href="peminjaman_buku.php" class="glass-card menu-card text-center h-100">
                <div class="icon-box">
                    <i class="bi bi-book-half"></i>
                </div>
                <h3>Peminjaman Buku</h3>
                <p class="opacity-75">Cari buku favoritmu dan ajukan pinjaman.</p>
            </a>
        </div>

        <div class="col-md-4">
            <a href="pengembalian_buku.php" class="glass-card menu-card text-center h-100">
                <div class="icon-box">
                    <i class="bi bi-arrow-return-left"></i>
                </div>
                <h3>Pengembalian</h3>
                <p class="opacity-75">Kembalikan buku yang sedang kamu pinjam.</p>
            </a>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="glass-card d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="fw-bold mb-1"><i class="bi bi-info-circle me-2"></i> Status Keanggotaan</h5>
                    <p class="small opacity-50 mb-0">Pastikan data profil kamu sudah sesuai.</p>
                </div>
                <span class="badge <?= ($data_mhs['status'] == 'Aktif') ? 'bg-success' : 'bg-danger'; ?> px-4 py-2 fs-6">
                    <?= $data_mhs['status'] ?? 'Tidak Diketahui'; ?>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalProfil" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark border-secondary text-white" style="border-radius: 20px; backdrop-filter: blur(15px);">
            <div class="modal-header border-secondary">
                <h5 class="modal-title fw-bold"><i class="bi bi-card-checklist me-2 text-warning"></i>Kartu Digital Anggota</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 profile-info">
                <?php if($data_mhs): ?>
                <div class="text-center mb-4">
                    <div class="display-1 text-warning"><i class="bi bi-person-circle"></i></div>
                    <h4 class="fw-bold mb-0"><?= $data_mhs['nama']; ?></h4>
                    <span class="badge bg-primary">ID: <?= $data_mhs['no_anggota']; ?></span>
                </div>
                <hr class="border-secondary">
                <div class="row g-3">
                    <div class="col-6">
                        <small class="text-white-50 d-block">Kelas</small>
                        <p class="fw-bold"><?= $data_mhs['kelas']; ?></p>
                    </div>
                    <div class="col-6">
                        <small class="text-white-50 d-block">Jenis Kelamin</small>
                        <p class="fw-bold"><?= ($data_mhs['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan'; ?></p>
                    </div>
                    <div class="col-12">
                        <small class="text-white-50 d-block">Status Akun</small>
                        <p class="fw-bold text-success"><i class="bi bi-check-circle-fill me-1"></i> Terverifikasi (<?= $data_mhs['status']; ?>)</p>
                    </div>
                </div>
                <?php else: ?>
                    <div class="alert alert-danger">Data anggota tidak ditemukan. Silakan hubungi admin.</div>
                <?php endif; ?>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal" style="border-radius: 12px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>