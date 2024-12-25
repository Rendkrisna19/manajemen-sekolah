<?php
session_start();
include '../fuction.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Ambil ID siswa dari URL
$id = $_GET['id'];

// Ambil data siswa berdasarkan ID
$student = $conn->query("SELECT * FROM students WHERE id = $id")->fetch_assoc();

// Cek jika data siswa tidak ditemukan
if (!$student) {
    echo "Data siswa tidak ditemukan.";
    exit();
}

// Proses form jika data di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];  // Ganti nama menjadi 'name' sesuai dengan nama input field
    $class = $_POST['class']; // Ganti kelas menjadi 'class' sesuai dengan nama input field

    // Update data siswa di database
    $stmt = $conn->prepare("UPDATE students SET name = ?, class = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $class, $id);

    if ($stmt->execute()) {
        // If successful, show success message and redirect after 2 seconds
        $successMessage = "Data siswa berhasil diperbarui!";
    } else {
        $errorMessage = "Gagal mengupdate data.";
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
    <title>Edit Siswa</title>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include 'slidebar.php' ?>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-3xl font-bold mb-6">Edit Data Siswa</h2>

            <!-- Form Edit siswa -->
            <form action="" method="POST" class="bg-white shadow rounded p-6 space-y-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Nama Siswa</label>
                    <input type="text" name="name" value="<?php echo $student['name']; ?>"
                        class="w-full border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Kelas</label>
                    <input type="text" name="class" value="<?php echo $student['class']; ?>"
                        class="w-full border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        required>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
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