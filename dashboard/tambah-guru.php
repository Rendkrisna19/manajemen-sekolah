<?php
session_start();
include '../fuction.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Proses tambah guru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $subject = $_POST['subject'];

    $stmt = $conn->prepare("INSERT INTO teachers (name, subject) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $subject);

    if ($stmt->execute()) {
        header("Location: guru.php");
    } else {
        echo "Gagal menambahkan data guru.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Tambah Guru</title>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include 'slidebar.php' ?>


        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-3xl font-bold mb-6">Tambah Data Guru</h2>

            <!-- Form Tambah Guru -->
            <form action="" method="POST" class="bg-white shadow rounded p-6 space-y-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Nama Guru</label>
                    <input type="text" name="name"
                        class=" border w-full border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Mata Pelajaran</label>
                    <input type="text" name="subject"
                        class=" border w-full border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        required>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </form>
        </div>
    </div>
</body>

</html>