<div class="bg-white p-5 rounded-3xl shadow-sm mb-6 flex items-center gap-4 border border-gray-100">
    <div class="relative">
        <div class="w-14 h-14 bg-gradient-to-tr from-orange-400 to-orange-200 rounded-2xl flex items-center justify-center text-white shadow-lg">
            <i class="fas fa-user-shield text-2xl"></i>
        </div>
        <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full"></div>
    </div>
    <div>
        <p class="text-slate-400 text-[10px] uppercase tracking-widest font-bold">Administrator</p>
        <p class="font-extrabold text-slate-800 text-lg leading-tight">admin </p>
        <p class="text-slate-400 text-xs">Sistem Perpustakaan v1.0</p>
    </div>
</div>

<h2 class="text-slate-700 font-bold mb-4 px-1 flex items-center gap-2">
    <span class="w-1 h-5 bg-green-500 rounded-full"></span> 
    Menu Utama
</h2>

<div class="grid grid-cols-2 gap-4">
    
    <a href="dashboard.php?page=buku" class="bg-blue-50 p-4 rounded-3xl border border-blue-100 transition active:scale-95">
        <div class="flex justify-between items-center mb-3">
            <div class="w-10 h-10 bg-blue-500 rounded-2xl flex items-center justify-center text-white shadow-sm">
                <i class="fas fa-book"></i>
            </div>
            <span class="text-2xl font-black text-blue-600"></span>
        </div>
        <p class="text-blue-800 font-bold text-xs uppercase tracking-wide">Data Buku</p>
    </a>

    <a href="dashboard.php?page=anggota" class="bg-purple-50 p-4 rounded-3xl border border-purple-100 transition active:scale-95">
        <div class="flex justify-between items-center mb-3">
            <div class="w-10 h-10 bg-purple-500 rounded-2xl flex items-center justify-center text-white shadow-sm">
                <i class="fas fa-users"></i>
            </div>
            <span class="text-2xl font-black text-purple-600"></span>
        </div>
        <p class="text-purple-800 font-bold text-xs uppercase tracking-wide">Anggota</p>
    </a>

    <a href="dashboard.php?page=transaksi" class="bg-orange-50 p-4 rounded-3xl border border-orange-100 transition active:scale-95">
        <div class="flex justify-between items-center mb-3">
            <div class="w-10 h-10 bg-orange-400 rounded-2xl flex items-center justify-center text-white shadow-sm">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <span class="text-2xl font-black text-orange-600"></span>
        </div>
        <p class="text-orange-800 font-bold text-xs uppercase tracking-wide">Transaksi</p>
    </a>

    <a href="dashboard.php?page=laporan" class="bg-emerald-50 p-4 rounded-3xl border border-emerald-100 transition active:scale-95">
        <div class="flex justify-between items-center mb-3">
            <div class="w-10 h-10 bg-emerald-500 rounded-2xl flex items-center justify-center text-white shadow-sm">
                <i class="fas fa-file-signature"></i>
            </div>
            <span class="text-2xl font-black text-emerald-600"></span>
        </div>
        <p class="text-emerald-800 font-bold text-xs uppercase tracking-wide">Laporan</p>
    </a>

</div>

<div class="mt-6 bg-slate-800 p-4 rounded-3xl text-white flex items-center justify-between overflow-hidden relative">
    <div class="relative z-10">
        <p class="text-[10px] text-slate-400 uppercase font-bold">Status Server</p>
        <p class="text-sm font-medium">Database Terhubung</p>
    </div>
    <i class="fas fa-server text-4xl absolute -right-2 opacity-20"></i>
    <div class="bg-green-500 px-3 py-1 rounded-full text-[10px] font-bold z-10">ONLINE</div>
</div>
