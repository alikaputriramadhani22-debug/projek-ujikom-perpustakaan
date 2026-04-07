<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota E-Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen p-6">

    <div class="bg-white w-full max-w-md rounded-[2.5rem] p-8 shadow-2xl border border-slate-100">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-plus text-2xl"></i>
            </div>
            <h2 class="text-2xl font-black text-slate-800">Daftar Anggota</h2>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-2">Silakan isi data diri kamu</p>
        </div>
        
        <form action="dashboard.php?page=anggota" method="POST" class="space-y-4">
            <input type="text" name="nama" placeholder="Nama Lengkap" class="w-full bg-slate-50 p-4 rounded-2xl text-sm border-none outline-none focus:ring-2 focus:ring-green-400 transition" required>
            
            <input type="text" name="no_anggota" placeholder="Nomor NIS / ID Siswa" class="w-full bg-slate-50 p-4 rounded-2xl text-sm border-none outline-none focus:ring-2 focus:ring-green-400 transition" required>
            
            <select name="jenis_kelamin" class="w-full bg-slate-50 p-4 rounded-2xl text-sm border-none outline-none focus:ring-2 focus:ring-green-400 transition">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
            
            <input type="text" name="kelas" placeholder="Kelas (Contoh: XII RPL 1)" class="w-full bg-slate-50 p-4 rounded-2xl text-sm border-none outline-none focus:ring-2 focus:ring-green-400 transition" required>

            <button type="submit" name="daftar_customer" class="w-full bg-green-600 text-white py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-lg shadow-green-100 active:scale-95 transition mt-4">
                KIRIM DATA DIRI
            </button>
            
            <p class="text-center text-[10px] text-slate-400 font-bold mt-6 uppercase">Sudah punya akun? <a href="login.php" class="text-green-600">Login Disini</a></p>
        </form>
    </div>

</body>
</html>