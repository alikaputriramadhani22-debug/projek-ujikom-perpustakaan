<?php
include 'koneksi.php';

// --- DEBUG KONEKSI ---
if (!$conn) {
    echo "<script>alert('Koneksi Gagal: " . mysqli_connect_error() . "');</script>";
}

// --- 1. PROSES HAPUS ---
if (isset($_GET['hapus_buku'])) {
    $judul_hapus = mysqli_real_escape_string($conn, $_GET['hapus_buku']);
    $query_hapus = "DELETE FROM tabel_data_buku WHERE judul = '$judul_hapus'";
    if (mysqli_query($conn, $query_hapus)) {
        echo "<script>alert('Berhasil dihapus!'); window.location.href='dashboard.php?page=buku';</script>";
    } else {
        $err = mysqli_error($conn);
        echo "<script>alert('Gagal Hapus: $err');</script>";
    }
}

// --- 2. PROSES TAMBAH ---
if (isset($_POST['simpan_buku'])) {
    $judul      = mysqli_real_escape_string($conn, $_POST['judul']);
    $pengarang  = mysqli_real_escape_string($conn, $_POST['pengarang']);
    $stok       = (int)$_POST['stok'];
    $status     = "aktif";

    // Debug Alert sebelum eksekusi
    echo "<script>alert('Mencoba simpan: $judul oleh $pengarang');</script>";

    // QUERY DIPERBAIKI: Kolom 'penerbit' dihapus karena tidak ada di gambar database Anda
    $query = "INSERT INTO tabel_data_buku (judul, pengarang, jumlah_buku, status) 
              VALUES ('$judul', '$pengarang', '$stok', '$status')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('SUKSES: Data tersimpan!'); window.location.href='dashboard.php?page=buku';</script>";
    } else {
        $error_db = mysqli_error($conn);
        echo "<script>alert('DATABASE ERROR: $error_db');</script>";
    }
}

// --- 3. PROSES EDIT ---
if (isset($_POST['update_buku'])) {
    $judul_lama = mysqli_real_escape_string($conn, $_POST['judul_lama']);
    $judul      = mysqli_real_escape_string($conn, $_POST['judul']);
    $pengarang  = mysqli_real_escape_string($conn, $_POST['pengarang']);
    $stok       = (int)$_POST['stok'];

    $query_update = "UPDATE tabel_data_buku SET 
                     judul = '$judul', 
                     pengarang = '$pengarang', 
                     jumlah_buku = '$stok' 
                     WHERE judul = '$judul_lama'";

    if (mysqli_query($conn, $query_update)) {
        echo "<script>alert('Update Berhasil!'); window.location.href='dashboard.php?page=buku';</script>";
    } else {
        $error_db = mysqli_error($conn);
        echo "<script>alert('Update Gagal: $error_db');</script>";
    }
}
?>

<div class="flex justify-between items-center mb-6 px-2">
    <div>
        <h2 class="text-xl font-bold text-slate-800">Koleksi Buku</h2>
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Database System</p>
    </div>
    <button onclick="openModal('modalTambah')" class="bg-green-500 text-white w-12 h-12 rounded-2xl shadow-lg flex items-center justify-center active:scale-90 transition">
        <i class="fas fa-plus"></i>
    </button>
</div>

<div class="grid gap-3 px-1">
    <?php
    $result = mysqli_query($conn, "SELECT * FROM tabel_data_buku ORDER BY id DESC");
    if ($result && mysqli_num_rows($result) > 0) {
        while($buku = mysqli_fetch_array($result)) {
    ?>
        <div class="bg-white p-4 rounded-3xl border border-gray-100 shadow-sm flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center text-lg">
                    <i class="fas fa-book"></i>
                </div>
                <div>
                    <h4 class="font-bold text-slate-800 leading-tight"><?php echo $buku['judul']; ?></h4>
                    <p class="text-[10px] text-slate-400 font-bold"><?php echo $buku['pengarang']; ?></p>
                    <span class="text-[9px] bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full font-bold">Stok: <?php echo $buku['jumlah_buku']; ?></span>
                </div>
            </div>
            <div class="flex gap-2">
                <button onclick="openEditModal('<?php echo addslashes($buku['judul']); ?>', '<?php echo addslashes($buku['pengarang']); ?>', '<?php echo $buku['jumlah_buku']; ?>')" 
                        class="w-8 h-8 bg-orange-50 text-orange-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-edit text-xs"></i>
                </button>
                <a href="dashboard.php?page=buku&hapus_buku=<?php echo urlencode($buku['judul']); ?>" 
                   onclick="return confirm('Hapus?')" class="w-8 h-8 bg-red-50 text-red-500 rounded-lg flex items-center justify-center text-xs">
                    <i class="fas fa-trash"></i>
                </a>
            </div>
        </div>
    <?php
        }
    } else {
        echo "<div class='text-center py-10 text-slate-400 text-xs italic'>Belum ada data di database.</div>";
    }
    ?>
</div>

<div id="modalTambah" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[99] hidden flex items-center justify-center p-6">
    <div class="bg-white w-full rounded-[30px] p-6">
        <h3 class="font-bold text-lg mb-4">Input Buku</h3>
        <form method="POST" class="space-y-3">
            <input type="text" name="judul" placeholder="Judul Buku" class="w-full bg-slate-50 p-3 rounded-xl text-sm outline-none border-none" required>
            <input type="text" name="pengarang" placeholder="Pengarang" class="w-full bg-slate-50 p-3 rounded-xl text-sm outline-none border-none" required>
            <input type="number" name="stok" placeholder="Jumlah Stok" class="w-full bg-slate-50 p-3 rounded-xl text-sm outline-none border-none" required>
            <div class="flex gap-2 pt-2">
                <button type="button" onclick="closeModal('modalTambah')" class="flex-1 py-3 text-slate-400 font-bold text-sm">Batal</button>
                <button type="submit" name="simpan_buku" class="flex-1 bg-green-500 text-white py-3 rounded-xl font-bold text-sm shadow-lg shadow-green-100">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEdit" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[99] hidden flex items-center justify-center p-6">
    <div class="bg-white w-full rounded-[30px] p-6">
        <h3 class="font-bold text-lg mb-4 text-orange-500">Edit Data</h3>
        <form method="POST" class="space-y-3">
            <input type="hidden" name="judul_lama" id="edit_judul_lama">
            <input type="text" name="judul" id="edit_judul" class="w-full bg-slate-50 p-3 rounded-xl text-sm outline-none border-none" required>
            <input type="text" name="pengarang" id="edit_pengarang" class="w-full bg-slate-50 p-3 rounded-xl text-sm outline-none border-none" required>
            <input type="number" name="stok" id="edit_stok" class="w-full bg-slate-50 p-3 rounded-xl text-sm outline-none border-none" required>
            <div class="flex gap-2 pt-2">
                <button type="button" onclick="closeModal('modalEdit')" class="flex-1 py-3 text-slate-400 font-bold text-sm">Batal</button>
                <button type="submit" name="update_buku" class="flex-1 bg-orange-500 text-white py-3 rounded-xl font-bold text-sm">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
function openEditModal(judul, pengarang, stok) {
    document.getElementById('edit_judul_lama').value = judul;
    document.getElementById('edit_judul').value = judul;
    document.getElementById('edit_pengarang').value = pengarang;
    document.getElementById('edit_stok').value = stok;
    openModal('modalEdit');
}
</script>
