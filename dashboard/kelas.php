<?php
session_start();
include '../fuction.php'; // Koneksi database

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Query untuk mendapatkan daftar kelas unik dari tabel students
$sql = "SELECT DISTINCT class FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Navbar -->
        <?php include 'slidebar.php'; ?>

        <!-- Main Content -->
        <main class="container mx-auto p-6">
            <h2 class="text-3xl font-bold mb-1">Daftar Kelas</h2>
            <p class="text-3x1 mb-6 p-2">klik tombol agar menampilkan nama dari masing masing setiap kelas</p>

            <!-- Daftar Kelas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                // Loop untuk menampilkan kotak kelas
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $class = $row['class'];
                        echo "
                        <a href='detail_kelas.php?class=$class' class='block bg-white shadow-lg rounded-lg p-6 text-center hover:bg-blue-100'>
                            <h3 class='text-xl font-semibold text-blue-600'>$class</h3>
                        </a>
                        ";
                    }
                } else {
                    echo "<p class='text-gray-500'>Tidak ada data kelas.</p>";
                }
                ?>
            </div>
        </main>
    </div>

</body>

</html>