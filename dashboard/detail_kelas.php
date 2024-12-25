<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kelas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    function searchStudent() {
        const searchValue = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#tableBody tr');

        rows.forEach(row => {
            const studentName = row.querySelector('.student-name').textContent.toLowerCase();
            row.style.display = studentName.includes(searchValue) ? '' : 'none';
        });
    }
    </script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg w-full max-w-4xl p-6">
        <h2 class="text-3xl font-bold text-center mb-6">
            Daftar Siswa Kelas
            <?php echo htmlspecialchars($_GET['class']); ?>
        </h2>

        <!-- Input Pencarian -->
        <div class="mb-4 text-center">
            <input type="text" id="searchInput" onkeyup="searchStudent()" placeholder="Cari nama siswa..."
                class="border border-gray-300 rounded-lg p-2 w-full max-w-md text-center" />
        </div>

        <!-- Tabel Daftar Siswa -->
        <table class="table-auto w-full text-center border-collapse border border-gray-300">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="border border-gray-300 p-4">No</th>
                    <th class="border border-gray-300 p-4">Nama Siswa</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php
                session_start();
                include '../fuction.php'; // Koneksi database

                // Cek apakah pengguna sudah login
                if (!isset($_SESSION['user'])) {
                    header("Location: ../auth/login.php");
                    exit();
                }

                // Ambil data siswa berdasarkan kelas
                $class = isset($_GET['class']) ? $_GET['class'] : '';
                $stmt = $conn->prepare("SELECT name FROM students WHERE class = ?");
                $stmt->bind_param("s", $class);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='odd:bg-gray-50 even:bg-gray-100'>";
                        echo "<td class='border border-gray-300 p-4'>" . $no++ . "</td>";
                        echo "<td class='border border-gray-300 p-4 student-name'>" . htmlspecialchars($row['name']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr>";
                    echo "<td colspan='2' class='border border-gray-300 p-4 text-gray-500'>Tidak ada data siswa</td>";
                    echo "</tr>";
                }

                $stmt->close();
                $conn->close();
                ?>
            </tbody>
        </table>

        <div class="text-center mt-6">
            <a href="kelas.php" class="text-blue-500 hover:underline">Kembali ke Daftar Kelas</a>
        </div>
    </div>
</body>

</html>