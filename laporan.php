<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Library - Panel Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f4f7f6; }
        .header-laporan { background-color: #28a745; color: white; padding: 15px; }
        .nav-tabs .nav-link { color: #666; font-weight: 500; border: none; }
        .nav-tabs .nav-link.active { color: #28a745; border-bottom: 3px solid #28a745; background: none; }
        .card-custom { border: none; border-radius: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        .badge-denda { background-color: #fff3cd; color: #856404; border: 1px solid #ffeeba; }
        
        @media print {
            .no-print { display: none !important; }
            .card-custom { box-shadow: none; border: 1px solid #ddd; }
        }
    </style>
</head>
<body>

    <div class="header-laporan d-flex justify-content-between align-items-center mb-3 no-print">
        <div class="d-flex align-items-center">
            <a href="index.php" class="text-white me-3"><i class="bi bi-arrow-left fs-4"></i></a>
            <h5 class="m-0 fw-bold">LAPORAN SISTEM</h5>
        </div>
        <button onclick="window.print()" class="btn btn-light btn-sm fw-bold">
            <i class="bi bi-printer me-1"></i> CETAK
        </button>
    </div>

    <div class="container pb-5">
        <ul class="nav nav-tabs mb-4 no-print" id="laporanTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="stok-tab" data-bs-toggle="tab" data-bs-target="#stok" type="button">Stok Buku</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="pinjam-tab" data-bs-toggle="tab" data-bs-target="#pinjam" type="button">Peminjaman</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="anggota-tab" data-bs-toggle="tab" data-bs-target="#anggota" type="button">Anggota Teraktif</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="denda-tab" data-bs-toggle="tab" data-bs-target="#denda" type="button">Denda</button>
            </li>
        </ul>

        <div class="tab-content" id="laporanTabContent">
            
            <div class="tab-pane fade show active" id="stok" role="tabpanel">
                <div class="card card-custom p-4">
                    <h6 class="fw-bold text-success mb-3"><i class="bi bi-archive me-2"></i>Daftar Stok & Kondisi Buku</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Judul Buku</th>
                                    <th>Total Stok</th>
                                    <th>Sering Dipinjam</th>
                                    <th>Rusak/Hilang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sains Dasar X</td>
                                    <td>25 Eks</td>
                                    <td><span class="badge bg-primary">120x</span></td>
                                    <td class="text-danger">0</td>
                                </tr>
                                <tr>
                                    <td>Filosofi Teras</td>
                                    <td>5 Eks</td>
                                    <td><span class="badge bg-primary">85x</span></td>
                                    <td class="text-danger">2</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pinjam" role="tabpanel">
                <div class="card card-custom p-4">
                    <h6 class="fw-bold text-success mb-3"><i class="bi bi-arrow-repeat me-2"></i>Data Transaksi Harian</h6>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Buku Dipinjam</th>
                                    <th>Buku Kembali</th>
                                    <th>Status Aktif</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>06 Feb 2026</td>
                                    <td>12 Buku</td>
                                    <td>8 Buku</td>
                                    <td><span class="badge bg-success">Sangat Aktif</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="anggota" role="tabpanel">
                <div class="card card-custom p-4 text-center">
                    <h6 class="fw-bold text-success mb-3 text-start"><i class="bi bi-star me-2"></i>Peringkat Anggota Teraktif</h6>
                    <div class="row g-3">
                        <div class="col-4">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <i class="bi bi-trophy-fill text-warning fs-2"></i>
                                <div class="fw-bold mt-2">Budi Santoso</div>
                                <small class="text-muted">45 Pinjaman</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 bg-light rounded shadow-sm border-top border-4 border-primary">
                                <i class="bi bi-person-circle fs-2 text-primary"></i>
                                <div class="fw-bold mt-2">Siti Aminah</div>
                                <small class="text-muted">38 Pinjaman</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-3 bg-light rounded shadow-sm">
                                <i class="bi bi-person-circle fs-2 text-secondary"></i>
                                <div class="fw-bold mt-2">Andi Wijaya</div>
                                <small class="text-muted">30 Pinjaman</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="denda" role="tabpanel">
                <div class="card card-custom p-4">
                    <h6 class="fw-bold text-success mb-3"><i class="bi bi-cash-stack me-2"></i>Rekap Kas Denda</h6>
                    <div class="bg-light p-3 rounded mb-3 text-center border">
                        <small class="text-muted d-block">TOTAL DENDATERKUMPUL</small>
                        <h3 class="fw-bold text-success m-0">Rp 450.000</h3>
                    </div>
                    <table class="table small">
                        <thead>
                            <tr>
                                <th>Nama Anggota</th>
                                <th>Keterlambatan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Rian Pratama</td>
                                <td>3 Hari</td>
                                <td class="fw-bold text-danger">Rp 15.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
