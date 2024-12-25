<?php
session_start();
include '../fuction.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Tambahkan data siswa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $class = $_POST['class'];

    $stmt = $conn->prepare("INSERT INTO students (name, class) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $class);

    if ($stmt->execute()) {
        // If successful, show success message and redirect after 2 seconds
        $successMessage = "Data siswa berhasil ditambahkan!";
    } else {
        $errorMessage = "Gagal menambahkan data siswa.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Tambah Siswa</title>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include 'slidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-3xl font-bold mb-6">Tambah Data Siswa</h2>

            <!-- Form Tambah Siswa -->
            <form action="" method="POST" class="bg-white shadow rounded p-6 space-y-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Nama Siswa</label>
                    <input type="text" name="name"
                        class="w-full border-gray-900 border rounded p-2 focus:ring-2 focus:ring-blue-600" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Kelas</label>
                    <input type="text" name="class"
                        class="w-full border-gray-900 border rounded p-2 focus:ring-2 focus:ring-blue-600" required>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </form>

            <!-- Success/Error Message -->
            <?php if (isset($successMessage)): ?>
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?php echo $successMessage; ?>',
                confirmButtonColor: '#3085d6',
                timer: 2000, // Show alert for 2 seconds before redirecting
            }).then(() => {
                window.location.href = "siswa.php"; // Redirect after success
            });
            </script>
            <?php elseif (isset($errorMessage)): ?>
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '<?php echo $errorMessage; ?>',
                confirmButtonColor: '#d33',
            });
            </script>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>