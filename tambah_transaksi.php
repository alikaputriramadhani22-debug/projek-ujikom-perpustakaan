<div class="p-6">
    <h2 class="text-xl font-bold mb-4">Tambah Peminjaman Baru</h2>
    <form action="proses_tambah.php" method="POST" class="space-y-4">
        <div>
            <label class="block text-sm font-medium">Judul Buku</label>
            <input type="text" name="judul" class="w-full border rounded-xl p-2" required>
        </div>
        <div>
            <label class="block text-sm font-medium">ID Customer</label>
            <input type="text" name="id_customer" class="w-full border rounded-xl p-2" required>
        </div>
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-xl">Simpan Transaksi</button>
        <a href="dashboard.php?page=transaksi" class="text-gray-500 ml-4">Batal</a>
    </form>
</div>
