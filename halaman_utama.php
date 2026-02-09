<?php
<h2 class="mb-4">Ringkasan Perpustakaan</h2>

<div class="row mb-4 text-white">
    <div class="col-md-3"><div class="card bg-primary p-3"><h5>Total Buku</h5> <h3>1,200</h3></div></div>
    <div class="col-md-3"><div class="card bg-success p-3"><h5>Dipinjam</h5> <h3>100</h3></div></div>
    <div class="col-md-3"><div class="card bg-warning p-3 text-dark"><h5>Anggota Aktif</h5> <h3>200</h3></div></div>
    <div class="col-md-3"><div class="card bg-danger p-3"><h5>Terlambat</h5> <h3>15</h3></div></div>
</div>

<div class="card p-4">
    <h5 class="mb-3">Peminjaman Terbaru</h5>
    <table class="table">
        <thead>
            <tr><th>Nama Anggota</th><th>Judul Buku</th><th>Tgl Pinjam</th><th>Status</th></tr>
        </thead>
        <tbody>
            <tr><td>Asep Rahman</td><td>sejarah 1933</td><td>2023-10-20</td><td><span class="badge bg-info">Dipinjam</span></td></tr>
            <tr><td>Liam Gallagher</td><td>sejarah oasis</td><td>2023-10-18</td><td><span class="badge bg-success">Kembali</span></td></tr>
        </tbody>
    </table>
</div>