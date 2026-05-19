<?php
session_start();
include __DIR__ . '/../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data - Sword of Logos Pustaka</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-slate-950 text-slate-100 min-h-full font-sans antialiased flex flex-col m-0 p-0">
    
    <main class="container mx-auto max-w-xl pt-16 pb-16 px-4 flex-1 flex flex-col justify-center">
        
        <!-- Tombol Kembali Bertema Ordo Ksatria -->
        <div class="mb-5">
            <a href="./dashboard.php" class="inline-flex items-center gap-2 text-sm font-bold text-slate-400 hover:text-amber-400 transition-colors duration-200 group">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:-translate-x-1">
                    <path d="m15 18-6-6 6-6"/>
                </svg>
                <span>Kembali ke Pustaka Utama</span>
            </a>
        </div>

        <!-- Kartu Tambah Data Bertema Wonder Ride Book -->
        <div class="bg-slate-900 p-8 rounded-3xl shadow-[0_4px_30px_rgba(220,38,38,0.15)] border border-slate-800 relative overflow-hidden">
            
            <!-- Dekorasi Bilah Energi Pedang Suci Kaenken Rekka -->
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-red-600 via-amber-500 to-red-600"></div>

            <div class="flex items-center gap-3 mb-6">
                <span class="text-xl">⚔️</span>
                <h2 class="text-2xl font-black text-transparent bg-gradient-to-r from-white via-slate-200 to-amber-400 bg-clip-text tracking-tight uppercase font-serif">
                    Registrasi Ksatria Baru
                </h2>
            </div>
            
            <form action="create.php" method="post" class="flex flex-col gap-5">
                
                <!-- Input Nama -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-black text-amber-400 uppercase tracking-widest pl-0.5">Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Masukkan nama lengkap" required
                        class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-600/20 transition-all duration-200">
                </div>

                <!-- Input Angkatan -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-black text-amber-400 uppercase tracking-widest pl-0.5">Tahun Lulus (Angkatan)</label>
                    <input type="text" name="angkatan" placeholder="Contoh: 2025" required
                        class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white placeholder-slate-500 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-600/20 transition-all duration-200">
                </div>

                <!-- Pilihan Jurusan -->
                <div class="flex flex-col gap-1.5">
                    <label class="text-xs font-black text-amber-400 uppercase tracking-widest pl-0.5">Faksi / Program Studi</label>
                    <div class="relative">
                        <select name="jurusan" required
                            class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-sm text-white focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-600/20 transition-all duration-200 appearance-none cursor-pointer">
                            <option value="" disabled selected>Pilih Jurusan</option>
                            <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                            <option value="Teknik Komputer dan Jaringan">Teknik Komputer dan Jaringan</option>
                            <option value="Teknik Jaringan Akses Telekomunikasi">Teknik Jaringan Akses Telekomunikasi</option>
                            <option value="Animasi">Animasi</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m6 9 6 6 6-6"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit Pembuatan -->
                <div class="mt-2">
                    <button type="submit" name="simpan" class="w-full bg-gradient-to-r from-red-700 via-rose-600 to-amber-600 hover:from-red-600 hover:to-amber-500 text-white font-black text-sm py-3.5 px-4 rounded-xl shadow-lg shadow-red-950/50 transition-all duration-200 flex items-center justify-center gap-2 active:scale-[0.98] border border-amber-400/20 uppercase tracking-wider cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                            <polyline points="17 21 17 13 7 13 7 21"/>
                            <polyline points="7 3 7 8 15 8"/>
                        </svg>
                        <span>Simpan Ke Kitab Sejarah</span>
                    </button>
                </div>

                <!-- Komponen Notifikasi Sukses / Hasil Eksekusi Query -->
                <div class="empty:hidden [&>p]:mt-2 [&>p]:p-4 [&>p]:bg-slate-950 [&>p]:border [&>p]:border-emerald-500/40 [&>p]:rounded-xl [&>p]:text-emerald-400 [&>p]:text-sm [&>p]:font-bold [&>p]:flex [&>p]:items-center [&>p]:justify-between [&>p_a]:bg-emerald-600 [&>p_a]:text-white [&>p_a]:px-3 [&>p_a]:py-1.5 [&>p_a]:rounded-lg [&>p_a]:font-black [&>p_a]:hover:bg-emerald-500 [&>p_a]:transition-colors [&>p_a]:no-underline shadow-inner">
                    <?php
                    if (isset($_POST['simpan'])) {
                        $sql = "INSERT INTO alumni (
                        nama,angkatan,jurusan
                        ) VALUES 
                        (
                        '$_POST[nama]',
                        '$_POST[angkatan]',
                        '$_POST[jurusan]')";
                        mysqli_query($koneksi, $sql);
                        echo "<p>Berhasil mencatat ksatria! <a href='./dashboard.php'>Kembali</a></p>";
                    }
                    ?>
                </div>

            </form>
        </div>
    </main>
</body>

</html>