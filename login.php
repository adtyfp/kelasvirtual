<?php
require_once 'koneksi.php';
session_start();

// Aktifkan error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$errors = [];
$success_message = "";
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'login';

// Redirect jika sudah login
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Handle form POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // === LOGIN ===
    if (isset($_POST['action']) && $_POST['action'] === 'login') {
        $email_nim = trim($_POST['email_nim']);
        $password = $_POST['password'];

        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR nim = ?");
            $stmt->execute([$email_nim, $email_nim]);
            $user = $stmt->fetch();

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['user_email'] = $user['email'];
                    
                    // Set cookie jika remember me dicentang
                    if (isset($_POST['remember_me'])) {
                        setcookie('user_id', $user['id'], time() + (86400 * 30), "/");
                        setcookie('user_name', $user['name'], time() + (86400 * 30), "/");
                    }

                    header('Location: index.php');
                    exit();
                } else {
                    $errors['login'] = "Password salah.";
                }
            } else {
                $errors['login'] = "Email/NIM tidak terdaftar.";
            }
            $active_tab = 'login';
        } catch (PDOException $e) {
            $errors['login'] = "Terjadi kesalahan sistem. Silakan coba lagi.";
            error_log("Login error: " . $e->getMessage());
        }
    }

    // === REGISTER ===
    if (isset($_POST['action']) && $_POST['action'] === 'register') {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $nim = trim($_POST['nim']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $note = '';

        // Validasi
        if (empty($name)) $errors['name'] = "Nama wajib diisi";
        if (empty($email)) {
            $errors['email'] = "Email wajib diisi";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Format email tidak valid";
        }
        if (empty($nim)) $errors['nim'] = "NIM wajib diisi";
        if (strlen($password) < 8) $errors['password'] = "Password minimal 8 karakter";
        if ($password !== $confirm_password) $errors['confirm_password'] = "Konfirmasi password tidak cocok";

        // Cek duplikat hanya jika tidak ada error validasi
        if (empty($errors)) {
            try {
                $check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ? OR nim = ?");
                $check->execute([$email, $nim]);
                if ($check->fetchColumn() > 0) {
                    $errors['email'] = "Email atau NIM sudah terdaftar";
                }
            } catch (PDOException $e) {
                $errors['register'] = "Error saat pengecekan data: " . $e->getMessage();
                error_log("Duplicate check error: " . $e->getMessage());
            }
        }

        // Proses registrasi jika tidak ada error
        if (empty($errors)) {
            try {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $insert = $pdo->prepare("INSERT INTO users (name, email, nim, password, note, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
                $insert->execute([$name, $email, $nim, $hash, $note]);

                if ($insert->rowCount() > 0) {
                    $success_message = "Registrasi berhasil! Silakan login.";
                    $active_tab = 'login';
                } else {
                    $errors['register'] = "Gagal melakukan registrasi. Tidak ada data yang dimasukkan.";
                }
            } catch (PDOException $e) {
                $errors['register'] = "Error saat registrasi: " . $e->getMessage();
                error_log("Registration error: " . $e->getMessage());
            }
        } else {
            $active_tab = 'register';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelas Virtual - Login/Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        .alert {
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
        }
        
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- Tab Navigation -->
        <div class="tabs-container">
            <div class="tabs">
                <div class="tab <?= $active_tab === 'login' ? 'active' : '' ?>" data-tab="login">Login</div>
                <div class="tab <?= $active_tab === 'register' ? 'active' : '' ?>" data-tab="register">Register</div>
            </div>
        </div>

        <!-- Logo -->
        <div class="logo-container">
            <img src="asset/kelas.png" alt="Kelas Virtual" />
        </div>

        <!-- Forms -->
        <div class="forms-wrapper">
            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
            <?php endif; ?>

            <!-- Login Form -->
            <div class="form-container <?= $active_tab === 'login' ? 'active' : '' ?>" id="login-form">
                <div class="form-wrapper">
                    <h2>Login di Sini</h2>
                    <p>Selamat Datang Kembali</p>
                </div>
                
                <?php if (isset($errors['login'])): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($errors['login']) ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <input type="hidden" name="action" value="login" />

                    <div class="input-group">
                        <label for="email_nim">Email/NIM</label>
                        <input type="text" id="email_nim" name="email_nim" required 
                               value="<?= isset($_POST['email_nim']) && $active_tab === 'login' ? htmlspecialchars($_POST['email_nim']) : '' ?>" />
                    </div>

                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required />
                    </div>

                    <div class="remember-me">
                        <input type="checkbox" id="remember_me" name="remember_me" />
                        <label for="remember_me">Ingatkan saya</label>
                    </div>

                    <button type="submit" class="btn">Login</button>
                </form>
            </div>

            <!-- Register Form -->
            <div class="form-container <?= $active_tab === 'register' ? 'active' : '' ?>" id="register-form">
                <div class="form-wrapper">
                    <h2>Registrasi</h2>
                    <p>Selamat Datang</p>
                </div>
                
                <?php if (isset($errors['register']) && !array_key_exists('email', $errors) && !array_key_exists('nim', $errors)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($errors['register']) ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <input type="hidden" name="action" value="register" />

                    <div class="input-group">
                        <label for="full_name">Nama Lengkap</label>
                        <input type="text" id="full_name" name="name" required 
                               value="<?= isset($_POST['name']) && $active_tab === 'register' ? htmlspecialchars($_POST['name']) : '' ?>" />
                        <?php if (isset($errors['name'])): ?>
                            <div class="error-message"><?= htmlspecialchars($errors['name']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required 
                               value="<?= isset($_POST['email']) && $active_tab === 'register' ? htmlspecialchars($_POST['email']) : '' ?>" />
                        <?php if (isset($errors['email'])): ?>
                            <div class="error-message"><?= htmlspecialchars($errors['email']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="input-group">
                        <label for="nim">NIM</label>
                        <input type="text" id="nim" name="nim" required 
                               value="<?= isset($_POST['nim']) && $active_tab === 'register' ? htmlspecialchars($_POST['nim']) : '' ?>" />
                        <?php if (isset($errors['nim'])): ?>
                            <div class="error-message"><?= htmlspecialchars($errors['nim']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="input-group">
                        <label for="reg_password">Password</label>
                        <input type="password" id="reg_password" name="password" required />
                        <?php if (isset($errors['password'])): ?>
                            <div class="error-message"><?= htmlspecialchars($errors['password']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="input-group">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" required />
                        <?php if (isset($errors['confirm_password'])): ?>
                            <div class="error-message"><?= htmlspecialchars($errors['confirm_password']) ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="remember-me">
                        <input type="checkbox" id="agree_terms" required checked />
                        <label for="agree_terms">Saya menyetujui syarat dan ketentuan</label>
                    </div>

                    <button type="submit" class="btn">Registrasi</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.tab');
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Update tab classes
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Update form visibility
                    const tabName = this.getAttribute('data-tab');
                    loginForm.classList.remove('active');
                    registerForm.classList.remove('active');
                    
                    if (tabName === 'login') {
                        loginForm.classList.add('active');
                    } else {
                        registerForm.classList.add('active');
                    }
                    
                    // Update URL tanpa reload
                    history.pushState(null, null, '?tab=' + tabName);
                });
            });
            
            // Handle browser back/forward buttons
            window.addEventListener('popstate', function() {
                const params = new URLSearchParams(window.location.search);
                const tab = params.get('tab') || 'login';
                
                tabs.forEach(t => t.classList.remove('active'));
                loginForm.classList.remove('active');
                registerForm.classList.remove('active');
                
                document.querySelector(`.tab[data-tab="${tab}"]`).classList.add('active');
                document.getElementById(`${tab}-form`).classList.add('active');
            });
        });
    </script>
</body>
</html>
