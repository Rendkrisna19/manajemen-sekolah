<?php
// Bisa ditambahkan dengan koneksi database jika diperlukan untuk data dinamis
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Sekolah Kami</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    body {
        font-family: 'Inter', sans-serif;
    }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex flex-col md:flex-row min-h-screen">
        <?php include 'slidebar.php'; ?>

        <!-- Konten utama -->
        <div class="flex-1 md:w-3/4 p-6">
            <!-- Hero Section -->
            <section class="relative bg-cover bg-center h-96 rounded-lg overflow-hidden shadow-md"
                style="background-image: url('../images/herosection.jpg');">
                <div class="absolute inset-0 bg-black opacity-50"></div>
                <div class="absolute inset-0 flex items-center justify-center text-center text-white">
                    <h1 class="text-4xl md:text-5xl font-bold">SMA SWASTA MITRA INALUM</h1>
                </div>
            </section>

            <!-- Biodata Sekolah -->
            <section class="my-12">
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <h2 class="text-3xl font-bold mb-6 text-gray-800">Biodata Sekolah</h2>
                    <div class="space-y-4">
                        <p class="text-lg text-gray-700">Nama Sekolah: <strong>SMA MITRA INALUM</strong></p>
                        <p class="text-lg text-gray-700">Tanggal Berdiri: <strong>9 Januari 1998</strong></p>
                        <p class="text-lg text-gray-700">Alamat: <strong>Perkebunan Sipare-Pare, Sei Suka, Batu Bara
                                Regency, North Sumatra 21257</strong></p>
                        <p class="text-lg text-gray-700">Visi: <strong>Menciptakan generasi yang berakhlak mulia dan
                                berprestasi tinggi.</strong></p>
                    </div>
                </div>
            </section>

            <!-- Blog Section -->
            <section class="my-12">
                <h2 class="text-3xl font-bold mb-6 text-gray-800">Blog </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Blog Post 1 -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="../images/kemah.png" alt="Kegiatan Pramuka" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-3">Kegiatan Pramuka di Sekolah</h3>
                            <p class="text-gray-700 mb-4">Pada bulan lalu, kami mengadakan kegiatan pramuka yang diikuti
                                oleh seluruh siswa...</p>
                            <a href="#" class="text-blue-500 hover:underline">Baca Selengkapnya</a>
                        </div>
                    </div>

                    <!-- Blog Post 2 -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="../images/lomba.jpeg" alt="Lomba Sains" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-3">Lomba Sains Sekolah</h3>
                            <p class="text-gray-700 mb-4">Sekolah kami baru saja menyelenggarakan lomba sains tingkat
                                nasional yang diikuti oleh siswa dari berbagai daerah...</p>
                            <a href="#" class="text-blue-500 hover:underline">Baca Selengkapnya</a>
                        </div>
                    </div>

                    <!-- Blog Post 3 -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img src="../images/kesehatan.png" alt="Penyuluhan Kesehatan" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-3">Penyuluhan Kesehatan untuk Siswa</h3>
                            <p class="text-gray-700 mb-4">Kami juga mengadakan penyuluhan kesehatan untuk siswa sebagai
                                bagian dari program kesehatan sekolah...</p>
                            <a href="#" class="text-blue-500 hover:underline">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>

</html>