<?php
include '../fuction.php'; // File koneksi database

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "<script>
            alert('Registrasi berhasil! Silakan login.');
            window.location.href = 'login.php';
        </script>";
    } else {
        $error = "Gagal registrasi. Silakan coba lagi.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Register</title>
</head>

<body class="bg-gray-100">
    <div class="relative h-screen bg-cover bg-center" style="background-image: url('../images/hero-login.jpg');">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="relative z-10 flex items-center justify-center h-full flex-col">

            <!-- Teks Selamat datang di atas form -->
            <div class="text-white text-center mb-8">
                <h1 class="text-4xl font-bold">Selamat datang di portal</h1>
                <h2 class="text-3xl font-semibold">SMA MITRA INALUM</h2>
            </div>

            <!-- Form Register dengan blur dan ukuran yang lebih kecil -->
            <div class="w-full max-w-md mx-auto mt-10 bg-white bg-opacity-60 backdrop-blur-sm p-8 rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold mb-6 text-center">Register</h1>
                <?php if (isset($error)): ?>
                <p class="text-red-500 mb-4 text-center"><?php echo $error; ?></p>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-6">
                        <label for="username" class="block text-sm font-medium">Username</label>
                        <input type="text" id="username" name="username" class="w-full px-4 py-3 border rounded-lg"
                            placeholder="Buat username" required>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3 border rounded-lg"
                            placeholder="Buat email yang valid" required>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium">Password</label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-3 border rounded-lg"
                            placeholder="Buat password yang aman" required>
                    </div>
                    <button type="submit" name="register"
                        class="w-full bg-blue-500 text-white py-3 rounded-lg text-lg">Register</button>
                </form>
                <div class="mt-6 text-center">
                    <p>Sudah punya akun? <a href="login.php" class="text-blue-500">Login di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>