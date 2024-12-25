<?php
session_start();
include '../fuction.php'; // Koneksi database

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Proses konfirmasi absensi
if (isset($_GET['confirm_id'])) {
    $confirm_id = $_GET['confirm_id'];
    $conn->query("UPDATE absensi_guru SET status = 'Confirmed' WHERE id = $confirm_id");
    header("Location: absensi-guru.php");
    exit();
}

// Proses hapus absensi
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $conn->query("DELETE FROM absensi_guru WHERE id = $delete_id");
    header("Location: absensi-guru.php");
    exit();
}

// Ambil data absensi guru dari database
$absensi_data = $conn->query("SELECT * FROM absensi_guru ORDER BY tanggal DESC, jam DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Absensi Guru</title>
</head>

<body class="bg-gray-100">

    <div class="flex h-screen">

        <!-- Sidebar -->
        <?php include 'slidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Absensi Guru</h2>

            <!-- Tabel Absensi -->
            <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4">Daftar Absensi Guru</h3>

                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left border-b">Nama Guru</th>
                            <th class="px-4 py-2 text-left border-b">Tanggal</th>
                            <th class="px-4 py-2 text-left border-b">Jam</th>
                            <th class="px-4 py-2 text-left border-b">Status</th>
                            <th class="px-4 py-2 text-left border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $absensi_data->fetch_assoc()) : ?>
                        <tr class="<?php echo $row['status'] == 'Confirmed' ? 'bg-green-100' : 'bg-red-100'; ?>">
                            <td class="px-4 py-2 border-b"><?php echo $row['nama']; ?></td>
                            <td class="px-4 py-2 border-b"><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                            <td class="px-4 py-2 border-b"><?php echo $row['jam']; ?></td>
                            <td class="px-4 py-2 border-b">
                                <span
                                    class="<?php echo $row['status'] == 'Confirmed' ? 'text-green-700' : 'text-red-700'; ?> font-semibold">
                                    <?php echo $row['status'] == 'Confirmed' ? 'Success' : 'Pending'; ?>
                                </span>
                            </td>
                            <td class="px-4 py-2 border-b">
                                <?php if ($row['status'] == 'Pending') : ?>
                                <!-- Modify the confirm link to trigger SweetAlert2 with yellow color -->
                                <a href="javascript:void(0);" onclick="confirmConfirmation(<?php echo $row['id']; ?>)"
                                    class="text-yellow-500 hover:underline mr-3">Konfirmasi</a>
                                <?php endif; ?>
                                <!-- Update Hapus link to trigger SweetAlert2 -->
                                <a href="javascript:void(0);" onclick="confirmDeletion(<?php echo $row['id']; ?>)"
                                    class="text-red-500 hover:underline">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 Script -->
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
                window.location.href = `absensi-guru.php?delete_id=${id}`;
            }
        });
    }

    function confirmConfirmation(id) {
        Swal.fire({
            title: 'Yakin ingin mengkonfirmasi absensi?',
            text: "Status absensi akan diubah menjadi 'Confirmed'!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#f39c12', // Yellow color
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Konfirmasi!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke halaman konfirmasi
                window.location.href = `absensi-guru.php?confirm_id=${id}`;
            }
        });
    }
    </script>

</body>

</html>