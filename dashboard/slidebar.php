<div class="bg-blue-600 text-white w-64 p-4">
    <div class="flex items-center mb-6">
        <img src="../images/logo.jpeg" alt="Logo" class="w-10 h-10 mr-4">
        <h1 class="text-2xl font-bold">SMA MITRA INALUM</h1>
    </div>
    <ul class="space-y-4">
        <!-- Dashboard -->
        <li>
            <a href="index.php" class="block py-2 px-4 bg-blue-700 rounded hover:bg-blue-800">
                Dashboard
            </a>
        </li>

        <!-- Dropdown Siswa -->
        <li class="relative group">
            <a href="#" class="flex items-center justify-between py-2 px-4 bg-blue-700 rounded hover:bg-blue-800">
                Siswa
                <span class="ml-2 transform group-hover:rotate-90 transition-transform">▼</span>
            </a>
            <div
                class="absolute left-full top-0 hidden group-hover:block mt-2 ml-1 bg-white text-gray-700 rounded shadow-lg z-10">
                <a href="siswa.php" class="block py-2 px-4 hover:bg-blue-200">Daftar Siswa</a>
                <a href="tambah-siswa.php" class="block py-2 px-4 hover:bg-blue-200">Tambahkan Data Siswa</a>
            </div>
        </li>

        <!-- Dropdown Guru -->
        <li class="relative group">
            <a href="#" class="flex items-center justify-between py-2 px-4 bg-blue-700 rounded hover:bg-blue-800">
                Guru
                <span class="ml-2 transform group-hover:rotate-90 transition-transform">▼</span>
            </a>
            <div
                class="absolute left-full top-0 hidden group-hover:block mt-2 ml-1 bg-white text-gray-700 rounded shadow-lg z-10">
                <a href="guru.php" class="block py-2 px-4 hover:bg-blue-200">Daftar Guru</a>
                <a href="tambah-guru.php" class="block py-2 px-4 hover:bg-blue-200">Tambahkan Guru</a>
            </div>
        </li>
        <li class="relative group">
            <a href="mata-pelajaran.php"
                class="flex items-center justify-between py-2 px-4 bg-blue-700 rounded hover:bg-blue-800">
                Mata Pelajaran
            </a>

        </li>
        <li class="relative group">
            <a href="absensi.php"
                class="flex items-center justify-between py-2 px-4 bg-blue-700 rounded hover:bg-blue-800">
                Absensi
            </a>

        </li>
        <li class="relative group">
            <a href="absensi-guru.php"
                class="flex items-center justify-between py-2 px-4 bg-blue-700 rounded hover:bg-blue-800">
                Daftar Absensi
            </a>

        </li>
        <li class="relative group">
            <a href="About.php"
                class="flex items-center justify-between py-2 px-4 bg-blue-700 rounded hover:bg-blue-800">
                Tentang Kami
            </a>

        </li>
        <li class="relative group">
            <a href="kelas.php"
                class="flex items-center justify-between py-2 px-4 bg-blue-700 rounded hover:bg-blue-800">
                Daftar Kelas
            </a>

        </li>
    </ul>
</div>