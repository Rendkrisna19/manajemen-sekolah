<?php
session_start();
include '../fuction.php'; // Koneksi database

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Ambil data mata pelajaran dari database
$subjects = $conn->query("SELECT * FROM mata_pelajaran");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Daftar Mata Pelajaran</title>
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <?php include 'slidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Daftar Mata Pelajaran</h2>

            <!-- Tabel Mata Pelajaran -->
            <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                <table class="table-auto w-full text-left border-collapse">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="py-3 px-4 text-sm font-semibold uppercase">ID</th>
                            <th class="py-3 px-4 text-sm font-semibold uppercase">Nama Mata Pelajaran</th>
                            <th class="py-3 px-4 text-sm font-semibold uppercase">Jumlah Jam SKS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($subject = $subjects->fetch_assoc()) : ?>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="py-3 px-4 text-sm text-gray-800"><?php echo $subject['id']; ?></td>
                            <td class="py-3 px-4 text-sm text-gray-800"><?php echo $subject['name']; ?></td>
                            <td class="py-3 px-4 text-sm text-gray-800"><?php echo $subject['hours']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>

</html>