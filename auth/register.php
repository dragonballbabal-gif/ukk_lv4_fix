<?php
session_start();
include __DIR__ . '/../koneksi.php';

// memeriksa btn registrasi telah di tekan(kirim)
if (isset($_POST['registrasi'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $insert = mysqli_query($koneksi, "INSERT INTO users (username,password,role) VALUES ('$username','$password','user')");

    // $hash_password = password_hash($password, PASSWORD_DEFAULT);
    if ($insert) {
        // jika insert berhasil , langsung set session
        $_SESSION['username'] = $username;
        $_SESSION['role'] = "user";

        header('location: ../user.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Rekrutmen Sword of Logos</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<!-- Menggunakan background gelap khas ordo Sword of Logos dengan sentuhan api merah -->
<body class="text-slate-200 min-h-screen flex items-center justify-center font-sans antialiased p-4 relative overflow-hidden bg-slate-950">

    <!-- Background Slider tetap dipertahankan sesuai kode asli -->
    <div class="absolute inset-0 -z-30">
        <div id="bg-slide-1" class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-40 scale-105"></div>
        <div id="bg-slide-2" class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 opacity-0 scale-105"></div>
    </div>

    <!-- Overlay gradasi dengan warna Kamen Rider Saber (Merah Api, Hitam, & Azure Blue dari efek pedang) -->
    <div class="absolute inset-0 bg-gradient-to-tr from-black via-red-950/70 to-slate-950/90 -z-20 backdrop-blur-[2px]"></div>

    <!-- Aura pedang suci Kaenken Rekka (Efek cahaya di latar belakang) -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-r from-red-600/30 via-orange-500/10 to-yellow-500/20 rounded-full blur-3xl -z-10 pointer-events-none animate-pulse"></div>

    <main class="w-full max-w-md relative z-10 transition-all duration-300">

        <!-- Card bertema Wonder Ride Book (Gelap, Border Emas, & Aksen Merah Menyala) -->
        <form action="register.php" method="post"
            class="bg-slate-900/90 backdrop-blur-2xl p-8 rounded-3xl shadow-[0_0_50px_rgba(220,38,38,0.25)] border-2 border-amber-500/40 flex flex-col gap-6 ring-4 ring-red-600/20 relative overflow-hidden">
            
            <!-- Aksen Garis Pembatas Buku Suci di Sisi Kiri -->
            <div class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-red-600 via-amber-500 to-red-600"></div>

            <div class="flex flex-col items-center text-center gap-3 mb-1 pl-2">
                <div class="relative group">
                    <!-- Efek membara di belakang logo -->
                    <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-amber-500 rounded-full blur-lg opacity-60 group-hover:opacity-90 transition-opacity duration-500"></div>
                    <img src="../img/logo.png" alt="Logo" class="relative w-22 h-22 object-contain rounded-full border-2 border-amber-400 shadow-lg bg-slate-950 p-1">
                </div>

                <div class="flex flex-col gap-1">
                    <!-- Teks judul dengan gradasi warna api/pedang Saber -->
                    <h1 class="text-2xl font-black tracking-wider bg-gradient-to-r from-red-500 via-amber-400 to-white bg-clip-text text-transparent uppercase font-serif drop-shadow-[0_2px_4px_rgba(0,0,0,0.8)]">
                        Sword of Logos
                    </h1>
                    <p class="text-xs text-slate-400 font-medium tracking-wide -mt-1">Pendaftaran Kesatria Baru</p>
                    <div class="mt-1">
                        <!-- Badge instansi disesuaikan warna emas/merah -->
                        <span class="text-[10px] font-extrabold tracking-widest uppercase bg-gradient-to-r from-red-700 to-amber-600 text-amber-100 px-4 py-1 rounded-md border border-amber-400/40 shadow-md">
                            SMK Telkom Lampung
                        </span>
                    </div>
                </div>
            </div>

            <!-- Input Username -->
            <div class="flex flex-col gap-1.5 ml-2">
                <label class="text-xs font-extrabold text-amber-400 uppercase tracking-widest pl-1 flex items-center gap-1">
                    <span>⚔️</span> Username Baru
                </label>
                <div class="relative">
                    <input type="text" name="username" placeholder="Buat Username Kesatria Anda"
                        class="w-full px-4 py-3.5 rounded-xl border border-slate-700 bg-slate-950/80 text-white text-sm placeholder-slate-500 focus:bg-slate-900 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-600/30 transition-all duration-300 shadow-inner" required>
                </div>
            </div>

            <!-- Input Password -->
            <div class="flex flex-col gap-1.5 ml-2">
                <label class="text-xs font-extrabold text-amber-400 uppercase tracking-widest pl-1 flex items-center gap-1">
                    <span>📖</span> Password Baru
                </label>
                <div class="relative">
                    <input type="password" name="password" placeholder="Buat Password Kuat Anda"
                        class="w-full px-4 py-3.5 rounded-xl border border-slate-700 bg-slate-950/80 text-white text-sm placeholder-slate-500 focus:bg-slate-900 focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-600/30 transition-all duration-300 shadow-inner" required>
                </div>
            </div>

            <div class="flex flex-col gap-5 mt-2 ml-2">
                <!-- Tombol Registrasi Berubah / Henshin Style -->
                <button type="submit" name="registrasi"
                    class="w-full bg-gradient-to-r from-red-700 via-rose-600 to-amber-600 bg-[size:200%_auto] hover:bg-right text-white font-black py-3.5 px-4 rounded-xl shadow-lg shadow-red-900/40 active:scale-[0.97] transition-all duration-500 text-sm cursor-pointer text-center tracking-widest uppercase border border-amber-400/50">
                    Daftar & Berubah!
                </button>

                <div class="w-full h-[2px] bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>

                <p class="text-xs text-slate-400 text-center font-medium">
                    Sudah memiliki takdir kesatria?
                    <a href="login.php" class="text-amber-400 font-bold hover:text-red-400 hover:underline transition-colors duration-200 ml-1">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </form>
    </main>

    <!-- Animasi pergantian gambar di background (Dipertahankan utuh) -->
    <script>
        const images = [
            '../img/bg3.png',
            '../img/bg1.jpg',
            '../img/bg2.jpg'
        ];

        let currentIndex = 0;
        const slide1 = document.getElementById('bg-slide-1');
        const slide2 = document.getElementById('bg-slide-2');

        slide1.style.backgroundImage = `url('${images[0]}')`;
        slide2.style.backgroundImage = `url('${images[1]} animate-pulse')`;

        let isSlide1Active = true;

        function changeBackground() {
            currentIndex = (currentIndex + 1) % images.length;
            const nextImage = images[currentIndex];

            if (isSlide1Active) {
                slide2.style.backgroundImage = `url('${nextImage}')`;
                slide1.classList.replace('opacity-40', 'opacity-0'); // Diturunkan ke 40 agar kontras tema gelap terjaga
                slide2.classList.replace('opacity-0', 'opacity-40');
            } else {
                slide1.style.backgroundImage = `url('${nextImage}')`;
                slide2.classList.replace('opacity-40', 'opacity-0');
                slide1.classList.replace('opacity-0', 'opacity-40');
            }
            isSlide1Active = !isSlide1Active;
        }

        setInterval(changeBackground, 4000); 
    </script>
</body>

</html>