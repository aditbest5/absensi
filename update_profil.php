<?php
include("config/connection.php");
session_start();

if (isset($_GET['act']) && $_GET['act'] == 'update_profil') {
    if (isset($_SESSION['user_id']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $userId = $_SESSION['user_id'];

        // Mengambil data dari formulir dan sanitasi input
        $name = sanitize_input($_POST['name']);
        $nik = sanitize_input($_POST['nik']);
        $email = filter_var(sanitize_input($_POST['email']), FILTER_SANITIZE_EMAIL);
        $username = sanitize_input($_POST['username']);
        $password = sanitize_input($_POST['password']);

        // Validasi data
        $errors = [];

        if (empty($name)) {
            $errors[] = "Name is required.";
        }
        if (empty($nik)) {
            $errors[] = "NIK is required.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }
        if (empty($username)) {
            $errors[] = "Username is required.";
        }

        if (count($errors) == 0) {
            // Buat query yang sesuai dengan kondisi apakah password diisi atau tidak
            if (empty($password)) {
                // Jika password tidak diisi, tidak perlu meng-update password
                $stmt = $conn->prepare("UPDATE tbl_users SET name = ?, nik = ?, email = ?, username = ? WHERE id = ?");
                if ($stmt === false) {
                    die("Prepare failed: " . htmlspecialchars($conn->error));
                }
                $bind = $stmt->bind_param("ssssi", $name, $nik, $email, $username, $userId);
            } else {
                // Jika password diisi, hash password dan sertakan dalam query
                $password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE tbl_users SET name = ?, nik = ?, email = ?, username = ?, password = ? WHERE id = ?");
                if ($stmt === false) {
                    die("Prepare failed: " . htmlspecialchars($conn->error));
                }
                $bind = $stmt->bind_param("sssssi", $name, $nik, $email, $username, $password, $userId);
            }

            if ($bind === false) {
                die("Bind failed: " . htmlspecialchars($stmt->error));
            }

            $execute = $stmt->execute();
            if ($execute) {
                echo "Profil berhasil diperbarui.";
                header("Location: setting");
                exit; // Pastikan untuk menghentikan eksekusi setelah header redirection
            } else {
                echo "Terjadi kesalahan saat memperbarui profil: " . htmlspecialchars($stmt->error);
                header("Location: setting?message=error");
                exit; // Pastikan untuk menghentikan eksekusi setelah header redirection
            }

            $stmt->close();
            $conn->close();
        } else {
            // Menampilkan kesalahan validasi
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        }
    } else {
        echo "Akses tidak diizinkan.";
        // Redirect atau berikan pesan kesalahan
    }
}

function sanitize_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}
