<?php
session_start();
include '../fuction.php'; // Koneksi database

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

// Data untuk Dashboard
$total_students = $conn->query("SELECT COUNT(*) as total FROM students")->fetch_assoc()['total'];
$total_teachers = $conn->query("SELECT COUNT(*) as total FROM teachers")->fetch_assoc()['total'];

// Simulasi data untuk chart perkembangan sekolah
$chart_data = [
    'Januari' => 50,
    'Februari' => 60,
    'Maret' => 70,
    'April' => 80,
    'Mei' => 90,
    'Juni' => 100,
    'Juli' => 110,
    'Agustus' => 120,
    'September' => 130,
    'Oktober' => 140,
    'November' => 150,
    'Desember' => 160,
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Ensure SweetAlert is included -->
    <title>Dashboard</title>
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?php include 'slidebar.php' ?>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <h2 class="text-3xl font-bold mb-6 text-blue-600">Dashboard</h2>

            <!-- Logout Button (Positioned to the top-right corner) -->
            <button onclick="confirmLogout()"
                class="bg-red-600 text-white px-4 py-2 rounded mb-6 hover:bg-red-700 focus:outline-none absolute top-6 right-6">
                Logout
            </button>

            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Total Siswa -->
                <div
                    class="bg-gradient-to-r from-blue-500 to-blue-700 text-white shadow-lg rounded p-6 flex items-center">
                    <div class="text-4xl mr-4">🎓</div>
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Total Siswa</h3>
                        <p class="text-3xl font-bold"><?php echo $total_students; ?></p>
                    </div>
                </div>

                <!-- Total Guru -->
                <div
                    class="bg-gradient-to-r from-green-500 to-green-700 text-white shadow-lg rounded p-6 flex items-center">
                    <div class="text-4xl mr-4">👨‍🏫</div>
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Total Guru</h3>
                        <p class="text-3xl font-bold"><?php echo $total_teachers; ?></p>
                    </div>
                </div>
            </div>

            <!-- Chart -->
            <div class="bg-white shadow rounded p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Perkembangan Sekolah (1 Tahun)</h3>
                <canvas id="schoolChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Script untuk Chart -->
    <script>
    const ctx = document.getElementById('schoolChart').getContext('2d');
    const schoolChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode(array_keys($chart_data)); ?>,
            datasets: [{
                label: 'Jumlah Siswa',
                data: <?php echo json_encode(array_values($chart_data)); ?>,
                borderColor: 'rgba(59, 130, 246, 1)',
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                borderWidth: 2,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                }
            },
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // SweetAlert Logout Confirmation
    function confirmLogout() {
        Swal.fire({
            title: 'Yakin ingin keluar?',
            text: "Anda akan keluar dari akun ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Keluar!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Clear session and redirect to login page
                window.location.href = '../auth/login.php';
            }
        });
    }
    </script>
</body>

</html>