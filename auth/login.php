<?php
include '../fuction.php'; 
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: ../dashboard/index.php");
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Pengguna tidak ditemukan.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
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

            <!-- Form Login dengan blur dan ukuran yang lebih kecil -->
            <div class="w-full max-w-md mx-auto mt-10 bg-white bg-opacity-60 backdrop-blur-sm p-8 rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold mb-6 text-center">Login</h1>
                <?php if (isset($error)): ?>
                <p class="text-red-500 mb-4 text-center"><?php echo $error; ?></p>
                <?php endif; ?>
                <form method="POST">
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3 border rounded-lg" required>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium">Password</label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-3 border rounded-lg"
                            required>
                    </div>
                    <button type="submit" name="login"
                        class="w-full bg-blue-500 text-white py-3 rounded-lg text-lg">Login</button>
                </form>
                <div class="mt-6 text-center">
                    <p>Belum punya akun? <a href="register.php" class="text-blue-500">Daftar di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>