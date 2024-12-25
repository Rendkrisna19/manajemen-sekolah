<?php
session_start();
include '../fuction.php'; // Koneksi database

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Query data siswa
$students = $conn->query("SELECT * FROM teachers");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Daftar Guru</title>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include 'slidebar.php' ?>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-3xl font-bold mb-6">Daftar Guru</h2>

            <!-- Tabel Guru -->
            <table class="table-auto w-full bg-white shadow rounded">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="p-4">ID</th>
                        <th class="p-4">Nama Guru</th>
                        <th class="p-4">Mata Pelajaran</th>
                        <th class="p-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $students->fetch_assoc()): ?>
                    <tr class="border-b">
                        <td class="p-4"><?php echo $row['id']; ?></td>
                        <td class="p-4"><?php echo $row['name']; ?></td>
                        <td class="p-4"><?php echo $row['subject']; ?></td>
                        <td class="p-4">
                            <a href="javascript:void(0);" onclick="confirmEdit(<?php echo $row['id']; ?>)"
                                class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
                            <a href="javascript:void(0);" onclick="confirmDeletion(<?php echo $row['id']; ?>)"
                                class="bg-red-500 text-white px-4 py-2 rounded">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    function confirmDeletion(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data ini tidak dapat dikembalikan setelah dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke halaman hapus
                window.location.href = `hapus-guru.php?id=${id}`;
            }
        });
    }

    function confirmEdit(id) {
        Swal.fire({
            title: 'Yakin ingin mengedit data guru?',
            text: "Pastikan data yang akan diedit sudah benar.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Edit!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke halaman edit
                window.location.href = `edit-guru.php?id=${id}`;
            }
        });
    }
    </script>
</body>

</html>