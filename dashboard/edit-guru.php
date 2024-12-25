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
$teachers = $conn->query("SELECT * FROM teachers WHERE id = $id")->fetch_assoc();

// Cek jika data siswa tidak ditemukan
if (!$teachers) {
    echo "Data siswa tidak ditemukan.";
    exit();
}

// Proses form jika data di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];  // Ganti nama menjadi 'name' sesuai dengan nama input field
    $class = $_POST['subject']; // Ganti kelas menjadi 'class' sesuai dengan nama input field

    // Update data siswa di database
    $stmt = $conn->prepare("UPDATE teachers SET name = ?, subject = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $subject, $id);

    if ($stmt->execute()) {
        header("Location: guru.php"); // Redirect ke halaman daftar siswa setelah berhasil update
    } else {
        echo "Gagal mengupdate data.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Siswa</title>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include 'slidebar.php' ?>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-3xl font-bold mb-6">Edit Data Guru</h2>

            <!-- Form Edit Siswa -->
            <form action="" method="POST" class="bg-white shadow rounded p-6 space-y-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Nama Guru</label>
                    <input type="text" name="name" value="<?php echo $teachers['name']; ?>"
                        class="w-full border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        required>
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Mata Pelajaran</label>
                    <input type="text" name="subject" value="<?php echo $teachers['subject']; ?>"
                        class="w-full border-gray-300 rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        required>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            </form>
        </div>
    </div>
</body>

</html>