<?php
session_start();
include 'koneksi.php';
if ($_SESSION['role'] != "user") {
    header('location: ./auth/login.php');
    header('location: ./auth/register.php');
    exit();
}

// Ambil jumlah total alumni untuk ditampilkan sebagai statistik kecil
$hitung_total = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM alumni");
$row_total = mysqli_fetch_assoc($hitung_total);
$total_alumni = $row_total['total'];
?>


<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sword of Logos Pustaka</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-slate-950 text-slate-100 min-h-full font-sans antialiased flex flex-col m-0 p-0">

    <header>
        <!-- Navigasi bertema bilah pedang suci Kaenken Rekka -->
        <nav class="fixed top-0 left-0 w-full bg-slate-900 border-b-2 border-amber-500/40 text-white py-3.5 px-4 shadow-[0_4px_30px_rgba(220,38,38,0.15)] z-50 backdrop-blur-md bg-opacity-95">
            <div class="container mx-auto max-w-7xl flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-3">
                    <span class="text-xl">⚔️</span>
                    <h1 class="text-xl font-black tracking-wider uppercase font-serif bg-gradient-to-r from-red-500 via-amber-400 to-white bg-clip-text text-transparent">
                        Sword of Logos
                    </h1>
                    <span class="hidden sm:inline-block text-[10px] font-extrabold uppercase tracking-widest bg-gradient-to-r from-slate-800 to-slate-700 text-amber-400 px-2.5 py-0.5 rounded border border-slate-700/60">User Panel</span>
                </div>

                <div class="flex flex-wrap items-center justify-center md:justify-end gap-5 w-full md:w-auto">
                    <div class="flex items-center gap-3 w-full sm:w-auto justify-center">
                        <div class="bg-slate-950 text-amber-400 py-2 px-4 text-xs font-black rounded-xl flex items-center gap-2 shadow-inner border border-slate-800">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user text-red-500">
                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            <p><?= $_SESSION['username'] ?></p>
                        </div>
                        <a href="logout.php" class="border border-red-600/50 bg-red-950/30 hover:bg-red-600 text-white text-xs py-2 px-4 font-bold rounded-xl transition-all duration-200 flex items-center gap-2 active:scale-[0.98]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out">
                                <path d="m16 17 5-5-5-5" />
                                <path d="M21 12H9" />
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                            </svg>
                            <p>Logout</p>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mx-auto max-w-7xl pt-28 pb-12 px-4 flex-1">

        <div id="content"></div>

        <!-- Bagian Kontrol Atas (Pencarian & Counter Total Alumni) -->
        <div class="bg-slate-900 p-6 rounded-2xl shadow-lg border border-slate-800 mb-6 flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-amber-500"></div>

            <div class="flex-1 max-w-2xl pl-2">
                <!-- Form Pencarian -->
                <form method="GET" class="flex items-center gap-2">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8" />
                                <path d="m21 21-4.3-4.3" />
                            </svg>
                        </div>
                        <input type="text" name="cari" placeholder="Cari Nama / Tahun Lulus / Jurusan..."
                            value="<?= isset($_GET['cari']) ? $_GET['cari'] : '' ?>"
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:border-red-500 focus:bg-slate-900 focus:ring-4 focus:ring-red-600/20 transition-all duration-200" required>
                    </div>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold text-sm px-5 py-2.5 rounded-xl cursor-pointer transition-colors active:scale-[0.98] border border-red-500/30">
                        Cari
                    </button>

                    <?php if (isset($_GET['cari']) && $_GET['cari'] != ''): ?>
                        <a href="user.php" class="bg-slate-800 hover:bg-slate-700 text-slate-300 p-2.5 rounded-xl transition-colors border border-slate-700 flex items-center justify-center" title="Reset Pencarian">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
                                <path d="M3 3v5h5" />
                            </svg>
                        </a>
                    <?php endif; ?>
                </form>
            </div>
            
            <!-- Counter Total Anggota Ordo Terdata -->
            <div class="flex items-center gap-2 self-end md:self-auto bg-slate-950 border border-slate-800 px-4 py-2 rounded-xl shadow-inner">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <p class="text-xs font-black text-slate-400 uppercase tracking-widest">
                    Arsip Terbuka: <span class="text-amber-400 font-extrabold ml-1"><?= $total_alumni ?> Ksatria</span>
                </p>
            </div>

        </div>

        <!-- Tabel Ringkasan Buku Sejarah Dunia -->
        <div class="bg-slate-900 rounded-2xl shadow-2xl border border-slate-800 overflow-hidden relative">
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-950 border-b border-slate-800 text-xs font-black text-amber-400 uppercase tracking-widest">
                            <th class="px-6 py-4 text-center w-20">No</th>
                            <th class="px-6 py-4">Nama Lengkap</th>
                            <th class="px-6 py-4">Tahun Lulus</th>
                            <th class="px-6 py-4">Jurusan/Program Studi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60">

                        <?php
                        if (isset($_GET['cari'])) {
                            $cari = $_GET['cari'];
                            $result = mysqli_query($koneksi, "SELECT * FROM alumni
                             WHERE nama LIKE '%$cari%'
                             OR angkatan LIKE '%$cari%'
                             OR jurusan LIKE '%$cari%'");
                        } else {
                            $result = mysqli_query($koneksi, "SELECT * FROM alumni");
                        }
                        ?>

                        <?php
                        while ($data = mysqli_fetch_assoc($result)) {
                            // Mengubah keluaran string echo ke format komponen UI bertema ordo
                            echo "<tr class='hover:bg-slate-950/50 transition-colors duration-150 text-sm text-slate-300 font-medium'>
                                     <td class='px-6 py-4 text-center font-bold text-slate-600'>{$data['id_alumni']}</td>
                                     <td class='px-6 py-4 font-bold text-white tracking-wide'>{$data['nama']}</td>
                                     <td class='px-6 py-4'>
                                         <span class='inline-flex items-center bg-red-950/60 text-red-400 text-xs px-2.5 py-1 rounded-md font-black border border-red-900/50 uppercase tracking-wider'>
                                             ✨ {$data['angkatan']}
                                         </span>
                                     </td>
                                     <td class='px-6 py-4 text-slate-400 font-normal'>📖 {$data['jurusan']}</td>
                                 </tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>

            <?php if (mysqli_num_rows($result) == 0): ?>
                <div class="p-12 text-center text-slate-500 text-sm font-medium">
                    <span class="text-3xl block mb-2">📜</span>
                    <p>Arsip Kitab Suci Tidak Ditemukan. Tidak ada data alumni.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Footer Pustaka Agung Ordo -->
    <footer class="mt-auto shrink-0 w-full bg-slate-950 text-slate-400 border-t border-slate-900 shadow-[0_-4px_20px_rgba(0,0,0,0.5)]">
        <div class="pt-6 py-2">
            <div class="container mx-auto max-w-7xl flex flex-col justify-center gap-3">
                <h1 class="text-xl text-center font-black uppercase tracking-widest font-serif bg-gradient-to-r from-red-500 to-amber-500 bg-clip-text text-transparent">Sword of Logos</h1>
                <p class="text-xs text-center font-normal text-slate-500 max-w-2xl mx-auto px-4 leading-relaxed">
                    Platform penelusuran data sejarah alumni untuk memetakan perkembangan karir, mempererat jejaring komunikasi sakral, dan membagikan percikan inspirasi antar generasi penerus kesatria.
                </p>
            </div>
        </div>

        <hr class="border-t border-slate-900 mt-5 mb-4 w-full max-w-md mx-auto" />

        <div class="pb-5 flex-col text-center text-[11px] text-slate-600 tracking-widest uppercase font-semibold">
            <p>&copy; 2026 <span class="text-slate-500">Tim rasyid_ux</span> × Sword of Logos Panel</p>
        </div>
    </footer>

</body>

</html>