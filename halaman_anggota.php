<?php
include 'koneksi.php';

/**
 * --- SISTEM DEBUG HP ---
 * Jika koneksi gagal, langsung ketahuan lewat alert.
 */
if (!$conn) {
    echo "<script>alert('❌ Koneksi Gagal: " . addslashes(mysqli_connect_error()) . "');</script>";
}

/**
 * --- 1. PROSES HAPUS ---
 */
if (isset($_GET['hapus_id'])) {
    $id_hapus = mysqli_real_escape_string($conn, $_GET['hapus_id']);
    $query_hapus = "DELETE FROM crud_anggota WHERE id = '$id_hapus'";
    
    if (mysqli_query($conn, $query_hapus)) {
        echo "<script>alert('✅ Data Berhasil Dihapus!'); window.location.href='dashboard.php?page=anggota';</script>";
    } else {
        echo "<script>alert('❌ Gagal Hapus: " . addslashes(mysqli_error($conn)) . "');</script>";
    }
}

/**
 * --- 2. PROSES TAMBAH ---
 */
if (isset($_POST['simpan_anggota'])) {
    $nama   = mysqli_real_escape_string($conn, $_POST['nama']);
    $no_agt = mysqli_real_escape_string($conn, $_POST['no_anggota']);
    $jk     = $_POST['jenis_kelamin']; 
    $kelas  = mysqli_real_escape_string($conn, $_POST['kelas']);
    $status = $_POST['status'];

    $query = "INSERT INTO crud_anggota (nama, no_anggota, jenis_kelamin, kelas, status) 
              VALUES ('$nama', '$no_agt', '$jk', '$kelas', '$status')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('✅ Data [$nama] Tersimpan!'); window.location.href='dashboard.php?page=anggota';</script>";
    } else {
        echo "<script>alert('❌ Gagal Simpan! Pesan Error: " . addslashes(mysqli_error($conn)) . "');</script>";
    }
}

/**
 * --- 3. PROSES EDIT ---
 */
if (isset($_POST['update_anggota'])) {
    $id_edit = $_POST['id_edit'];
    $nama    = mysqli_real_escape_string($conn, $_POST['nama']);
    $no_agt  = mysqli_real_escape_string($conn, $_POST['no_anggota']);
    $jk      = $_POST['jenis_kelamin'];
    $kelas   = mysqli_real_escape_string($conn, $_POST['kelas']);
    $status  = $_POST['status'];

    $query_update = "UPDATE crud_anggota SET 
                     nama = '$nama', 
                     no_anggota = '$no_agt', 
                     jenis_kelamin = '$jk',
                     kelas = '$kelas',
                     status = '$status'
                     WHERE id = '$id_edit'";

    if (mysqli_query($conn, $query_update)) {
        echo "<script>alert('✅ Berhasil Update Data!'); window.location.href='dashboard.php?page=anggota';</script>";
    } else {
        echo "<script>alert('❌ Gagal Update: " . addslashes(mysqli_error($conn)) . "');</script>";
    }
}
?>

<div class="flex justify-between items-center mb-6 px-2">
    <div>
        <h2 class="text-xl font-bold text-slate-800">Data Anggota</h2>
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">Database: crud_anggota</p>
    </div>
    <button onclick="openModal('modalTambah')" class="bg-green-500 text-white w-12 h-12 rounded-2xl shadow-lg flex items-center justify-center active:scale-95 transition">
        <i class="fas fa-plus"></i>
    </button>
</div>

<div class="grid gap-3 px-1">
    <?php
    $result = mysqli_query($conn, "SELECT * FROM crud_anggota ORDER BY id DESC");
    
    // Debug jika query SELECT error
    if (!$result) {
        echo "<div class='p-4 bg-red-100 text-red-600 rounded-xl text-xs'>Query Error: " . mysqli_error($conn) . "</div>";
    } elseif (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_array($result)) {
            $statusColor = ($row['status'] == 'Aktif') ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600';
    ?>
        <div class="bg-white p-4 rounded-3xl border border-gray-100 shadow-sm flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center">
                    <i class="fas fa-user text-sm"></i>
                </div>
                <div>
                    <h4 class="font-bold text-slate-800 text-sm leading-tight"><?= htmlspecialchars($row['nama']); ?></h4>
                    <p class="text-[10px] text-slate-400 font-bold uppercase"><?= $row['no_anggota']; ?> • <?= $row['kelas']; ?></p>
                    <span class="text-[9px] <?= $statusColor; ?> px-2 py-0.5 rounded-full font-bold"><?= $row['status']; ?></span>
                </div>
            </div>
            <div class="flex gap-2">
                <button onclick="openEditModal('<?= $row['id']; ?>', '<?= addslashes($row['nama']); ?>', '<?= $row['no_anggota']; ?>', '<?= $row['jenis_kelamin']; ?>', '<?= $row['kelas']; ?>', '<?= $row['status']; ?>')" 
                        class="w-8 h-8 bg-orange-50 text-orange-400 rounded-lg flex items-center justify-center">
                    <i class="fas fa-edit text-xs"></i>
                </button>
                <a href="dashboard.php?page=anggota&hapus_id=<?= $row['id']; ?>" 
                   onclick="return confirm('Yakin ingin menghapus <?= addslashes($row['nama']); ?>?')" 
                   class="w-8 h-8 bg-red-50 text-red-400 rounded-lg flex items-center justify-center">
                    <i class="fas fa-trash text-xs"></i>
                </a>
            </div>
        </div>
    <?php
        }
    } else {
        echo "<div class='text-center py-10 text-slate-400 text-xs italic'>Data tidak ditemukan atau masih kosong.</div>";
    }
    ?>
</div>

<div id="modalTambah" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[99] hidden flex items-center justify-center p-6">
    <div class="bg-white w-full rounded-[30px] p-6 shadow-2xl">
        <h3 class="font-bold text-lg mb-4">Input Anggota</h3>
        <form method="POST" class="space-y-3">
            <input type="text" name="nama" placeholder="Nama Lengkap" class="w-full bg-slate-50 p-3 rounded-xl text-sm border-none outline-none" required>
            <input type="text" name="no_anggota" placeholder="No Anggota" class="w-full bg-slate-50 p-3 rounded-xl text-sm border-none outline-none" required>
            <select name="jenis_kelamin" class="w-full bg-slate-50 p-3 rounded-xl text-sm border-none outline-none">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
            <input type="text" name="kelas" placeholder="Kelas" class="w-full bg-slate-50 p-3 rounded-xl text-sm border-none outline-none" required>
            <select name="status" class="w-full bg-slate-50 p-3 rounded-xl text-sm border-none outline-none">
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
            <div class="flex gap-2 pt-2">
                <button type="button" onclick="closeModal('modalTambah')" class="flex-1 py-3 text-slate-400 font-bold text-sm">Batal</button>
                <button type="submit" name="simpan_anggota" class="flex-1 bg-green-500 text-white py-3 rounded-xl font-bold text-sm shadow-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="modalEdit" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[99] hidden flex items-center justify-center p-6">
    <div class="bg-white w-full rounded-[30px] p-6 shadow-2xl">
        <h3 class="font-bold text-lg mb-4 text-orange-500">Ubah Data</h3>
        <form method="POST" class="space-y-3">
            <input type="hidden" name="id_edit" id="edit_id">
            <input type="text" name="nama" id="edit_nama" class="w-full bg-slate-100 p-3 rounded-xl text-sm border-none outline-none" required>
            <input type="text" name="no_anggota" id="edit_no_agt" class="w-full bg-slate-100 p-3 rounded-xl text-sm border-none outline-none" required>
            <select name="jenis_kelamin" id="edit_jk" class="w-full bg-slate-100 p-3 rounded-xl text-sm border-none outline-none">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
            <input type="text" name="kelas" id="edit_kelas" class="w-full bg-slate-100 p-3 rounded-xl text-sm border-none outline-none" required>
            <select name="status" id="edit_status" class="w-full bg-slate-100 p-3 rounded-xl text-sm border-none outline-none">
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
            <div class="flex gap-2 pt-2">
                <button type="button" onclick="closeModal('modalEdit')" class="flex-1 py-3 text-slate-400 font-bold text-sm">Batal</button>
                <button type="submit" name="update_anggota" class="flex-1 bg-orange-500 text-white py-3 rounded-xl font-bold text-sm shadow-lg">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
/**
 * --- JAVASCRIPT LOGIC ---
 */
function openModal(id) { 
    const target = document.getElementById(id);
    if(target) target.classList.remove('hidden');
}

function closeModal(id) { 
    const target = document.getElementById(id);
    if(target) target.classList.add('hidden');
}

function openEditModal(id, nama, no_agt, jk, kelas, status) {
    // Pengisian data ke form edit
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_no_agt').value = no_agt;
    document.getElementById('edit_jk').value = jk;
    document.getElementById('edit_kelas').value = kelas;
    document.getElementById('edit_status').value = status;
    
    openModal('modalEdit');
}
</script>
