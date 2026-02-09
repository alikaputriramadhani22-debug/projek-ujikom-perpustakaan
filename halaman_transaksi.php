-<?php 
include "koneksi.php"; 

// Pastikan variabel koneksi aman
if (!isset($koneksi)) { $koneksi = $conn; } 

/**
 * --- LOGIKA SIMPAN & HAPUS ---
 */
if(isset($_POST['simpan_transaksi'])){
    $id_cus = mysqli_real_escape_string($koneksi, $_POST['id_customer']);
    $judul  = mysqli_real_escape_string($koneksi, $_POST['judul_buku']);
    $tgl_p  = $_POST['tgl_pinjam'];
    $tgl_k  = $_POST['tgl_kembali'];

    $query_insert = "INSERT INTO tabel_transaksi (id_customer, judul_buku, tanggal_peminjaman, tanggal_pengembalian) 
                     VALUES ('$id_cus', '$judul', '$tgl_p', '$tgl_k')";

    if(mysqli_query($koneksi, $query_insert)){
        echo "<script>alert('✅ Transaksi Berhasil!'); window.location='dashboard.php?page=transaksi';</script>";
    } else {
        echo "<script>alert('❌ Gagal: " . addslashes(mysqli_error($koneksi)) . "');</script>";
    }
}

if(isset($_GET['hapus_pinjam'])){
    $id = mysqli_real_escape_string($koneksi, $_GET['hapus_pinjam']);
    $query_hapus = "DELETE FROM tabel_transaksi WHERE id_customer = '$id'";
    if(mysqli_query($koneksi, $query_hapus)){
        echo "<script>alert('✅ Berhasil Dihapus!'); window.location='dashboard.php?page=transaksi';</script>";
    }
}
?>

<div class="flex justify-between items-end mb-6 px-1">
    <div>
        <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Peminjaman</h2>
        <p class="text-[11px] text-green-600 font-bold uppercase tracking-wider">Log Transaksi</p>
    </div>
    <button onclick="toggleModal('modalPinjam')" class="bg-green-600 text-white px-4 py-2 rounded-2xl shadow-lg shadow-green-200 flex items-center gap-2 active:scale-95 transition">
        <i class="fas fa-plus text-xs"></i>
        <span class="text-xs font-bold">Baru</span>
    </button>
</div>

<div class="space-y-4">
    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM tabel_transaksi ORDER BY id_customer DESC");
    if($query && mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_array($query)){
    ?>
        <div class="bg-white p-4 rounded-[2rem] shadow-sm border border-gray-50 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center shadow-inner">
                    <i class="fas fa-exchange-alt"></i>
                </div>
                <div>
                    <h4 class="font-bold text-slate-800 text-sm leading-tight"><?php echo $row['judul_buku']; ?></h4>
                    <p class="text-[10px] font-semibold text-slate-400">ID Anggota: <span class="text-blue-500"><?php echo $row['id_customer']; ?></span></p>
                    <div class="flex gap-2 mt-2">
                        <div class="bg-slate-50 px-2 py-1 rounded-lg border border-gray-100">
                            <p class="text-[8px] text-slate-400 font-bold uppercase">Pinjam</p>
                            <p class="text-[10px] font-bold text-slate-700"><?php echo $row['tanggal_peminjaman']; ?></p>
                        </div>
                        <div class="bg-red-50 px-2 py-1 rounded-lg border border-red-100">
                            <p class="text-[8px] text-red-400 font-bold uppercase">Kembali</p>
                            <p class="text-[10px] font-bold text-red-600"><?php echo $row['tanggal_pengembalian']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <a href="dashboard.php?page=transaksi&hapus_pinjam=<?php echo $row['id_customer']; ?>" 
               onclick="return confirm('Hapus data ini?')" 
               class="w-10 h-10 bg-gray-50 text-red-400 rounded-2xl flex items-center justify-center active:bg-red-50 active:text-red-600 transition">
                <i class="fas fa-trash-alt text-sm"></i>
            </a>
        </div>
    <?php 
        }
    } else {
        echo "
        <div class='flex flex-col items-center justify-center py-20 opacity-30 text-slate-500'>
            <i class='fas fa-folder-open text-5xl mb-3'></i>
            <p class='text-sm font-bold italic text-center'>Belum ada data transaksi.</p>
        </div>";
    }
    ?>
</div>

<div id="modalPinjam" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-6">
    <div class="bg-white w-full max-w-md rounded-[2.5rem] p-8 shadow-2xl overflow-hidden relative">
        <div class="absolute top-0 left-0 w-full h-2 bg-green-600"></div>
        
        <h3 class="text-xl font-black text-slate-800 mb-6">Tambah Pinjaman</h3>
        
        <form method="POST" class="space-y-4">
            <div>
                <label class="text-[10px] font-black text-slate-400 ml-2 uppercase tracking-widest">Pilih Anggota</label>
                <div class="relative mt-1">
                    <select name="id_customer" class="w-full bg-slate-50 p-4 rounded-2xl text-xs font-bold appearance-none outline-none border-2 border-transparent focus:border-green-500 transition" required>
                        <option value="">-- Cari Nama --</option>
                        <?php
                        $agt = mysqli_query($koneksi, "SELECT * FROM crud_anggota");
                        while($d = mysqli_fetch_array($agt)){
                            echo "<option value='".$d['no_anggota']."'>".$d['nama']." (".$d['no_anggota'].")</option>";
                        }
                        ?>
                    </select>
                    <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 text-[10px]"></i>
                </div>
            </div>

            <div>
                <label class="text-[10px] font-black text-slate-400 ml-2 uppercase tracking-widest">Pilih Buku</label>
                <div class="relative mt-1">
                    <select name="judul_buku" class="w-full bg-slate-50 p-4 rounded-2xl text-xs font-bold appearance-none outline-none border-2 border-transparent focus:border-green-500 transition" required>
                        <option value="">-- Judul Buku --</option>
                        <?php
                        $buku = mysqli_query($koneksi, "SELECT * FROM tabel_data_buku");
                        while($b = mysqli_fetch_array($buku)){
                            echo "<option value='".$b['judul']."'>".$b['judul']."</option>";
                        }
                        ?>
                    </select>
                    <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-300 text-[10px]"></i>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-[10px] font-black text-slate-400 ml-2 uppercase tracking-widest">Tgl Pinjam</label>
                    <input type="date" name="tgl_pinjam" class="w-full mt-1 bg-slate-50 p-4 rounded-2xl text-xs font-bold outline-none" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div>
                    <label class="text-[10px] font-black text-slate-400 ml-2 uppercase tracking-widest">Tgl Kembali</label>
                    <input type="date" name="tgl_kembali" class="w-full mt-1 bg-slate-50 p-4 rounded-2xl text-xs font-bold outline-none border-2 border-red-50 focus:border-red-200" required>
                </div>
            </div>

            <div class="flex flex-col gap-2 pt-4">
                <button type="submit" name="simpan_transaksi" class="w-full bg-green-600 text-white py-4 rounded-2xl font-black text-xs shadow-lg shadow-green-100 active:scale-[0.98] transition">
                    SIMPAN TRANSAKSI
                </button>
                <button type="button" onclick="toggleModal('modalPinjam')" class="w-full py-3 text-slate-400 font-bold text-xs uppercase tracking-tighter">
                    Tutup
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleModal(id) {
    const modal = document.getElementById(id);
    modal.classList.toggle('hidden');
}
</script>