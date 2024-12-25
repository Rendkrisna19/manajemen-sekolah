<?php
session_start();
include '../fuction.php'; // Koneksi database

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Konfigurasi paginasi
$rowsPerPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1); // Pastikan halaman minimal 1
$offset = ($page - 1) * $rowsPerPage;

// Query data siswa dengan paginasi dan pengurutan khusus
$totalRows = $conn->query("SELECT COUNT(*) as count FROM students")->fetch_assoc()['count'];
$totalPages = ceil($totalRows / $rowsPerPage);

$students = $conn->query("
    SELECT * 
    FROM students 
    ORDER BY FIELD(class, '10A', '10B', '10C', '11A', '11B', '11C', '12A', '12B', '12C') 
    LIMIT $rowsPerPage OFFSET $offset
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Daftar Siswa</title>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include 'slidebar.php' ?>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-3xl font-bold mb-6">Daftar Siswa</h2>

            <!-- Tabel Siswa -->
            <div class="overflow-x-auto">
                <table class="table-auto w-full bg-white shadow rounded">
                    <thead>
                        <tr class="bg-blue-600 text-white">
                            <th class="p-4">ID</th>
                            <th class="p-4">Nama Siswa</th>
                            <th class="p-4">Kelas</th>
                            <th class="p-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $students->fetch_assoc()): ?>
                        <tr class="border-b">
                            <td class="p-4"><?php echo $row['id']; ?></td>
                            <td class="p-4"><?php echo $row['name']; ?></td>
                            <td class="p-4"><?php echo $row['class']; ?></td>
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

            <!-- Pagination -->
            <div class="mt-4 flex justify-between items-center">
                <a href="?page=<?php echo max($page - 1, 1); ?>"
                    class="bg-blue-500 text-white px-4 py-2 rounded <?php echo $page == 1 ? 'opacity-50 pointer-events-none' : ''; ?>">Previous</a>
                <span>Halaman <?php echo $page; ?> dari <?php echo $totalPages; ?></span>
                <a href="?page=<?php echo min($page + 1, $totalPages); ?>"
                    class="bg-blue-500 text-white px-4 py-2 rounded <?php echo $page == $totalPages ? 'opacity-50 pointer-events-none' : ''; ?>">Next</a>
            </div>
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
                window.location.href = `hapus-siswa.php?id=${id}`;
            }
        });
    }

    function confirmEdit(id) {
        Swal.fire({
            title: 'Yakin ingin mengedit data siswa?',
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
                window.location.href = `edit-siswa.php?id=${id}`;
            }
        });
    }
    </script>
</body>

</html>