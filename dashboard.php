<?php
include "koneksi.php"; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Library Mobile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans text-sm">

    <header class="bg-green-600 text-white p-4 sticky top-0 z-50 flex justify-between items-center shadow-md">
        <div class="flex items-center gap-2">
            <i class="fas fa-book-reader text-xl"></i>
            <h1 class="font-bold tracking-tight uppercase">E-Library</h1>
        </div>
        <button class="text-xl px-2"><i class="fas fa-bars"></i></button>
    </header>

    <main class="p-4">
        <?php 
        // Logika Perpindahan Halaman
        if(isset($_GET['page'])){
            $page = $_GET['page'];

            switch ($page) {
                case 'home':
                    include "home.php";
                    break;
                case 'buku':
                    include("halaman_buku.php");
                    break;
                case 'anggota':
                    include("halaman_anggota.php");
                    break;
                case 'transaksi':
                    include("halaman_transaksi.php");
                    break;
                default:
                    echo "<div class='text-center p-10'>Halaman tidak ditemukan!</div>";
                    break;
            }
        } else {
            // Default jika tidak ada parameter ?page
            include "home.php";
        }
        ?>
    </main>

    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 flex justify-around p-2 pb-4 shadow-lg z-50">
        <a href="dashboard.php?page=home" class="flex flex-col items-center <?= (!isset($_GET['page']) || $_GET['page'] == 'home') ? 'text-green-600' : 'text-slate-400' ?>">
            <i class="fas fa-home text-lg"></i>
            <span class="text-[10px] mt-1 font-bold">Home</span>
        </a>
        <a href="dashboard.php?page=buku" class="flex flex-col items-center <?= ($_GET['page'] == 'buku') ? 'text-green-600' : 'text-slate-400' ?>">
            <i class="fas fa-book text-lg"></i>
            <span class="text-[10px] mt-1 font-bold">Buku</span>
        </a>
        <a href="dashboard.php?page=anggota" class="flex flex-col items-center <?= ($_GET['page'] == 'anggota') ? 'text-green-600' : 'text-slate-400' ?>">
            <i class="fas fa-users text-lg"></i>
            <span class="text-[10px] mt-1 font-bold">Anggota</span>
        </a>
    </nav>

    <div class="h-20"></div> 
</body>
</html>
