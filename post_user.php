<?php
require_once "config.php";

// Fungsi untuk membersihkan input
function cleanInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Direktori untuk menyimpan file upload
$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Ambil data dari form-data (via $_POST dan $_FILES)
$name = isset($_POST["name"]) ? cleanInput($_POST["name"]) : "";
$email = isset($_POST["email"]) ? cleanInput($_POST["email"]) : "";
$password = isset($_POST["password"]) ? password_hash($_POST["password"], PASSWORD_DEFAULT) : "";
$role_id = isset($_POST["role_id"]) ? (int)$_POST["role_id"] : null;
$profile_image = null;

// Tangani upload file profile_image (jika ada)
if (isset($_FILES["profile_image"]) && $_FILES["profile_image"]["error"] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES["profile_image"]["tmp_name"];
    $fileName = $_FILES["profile_image"]["name"];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExts = ["jpg", "jpeg", "png"];

    // Validasi ekstensi file
    if (in_array($fileExt, $allowedExts)) {
        $newFileName = uniqid() . "." . $fileExt;
        $destPath = $uploadDir . $newFileName;
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $profile_image = $newFileName;
        } else {
            http_response_code(500);
            echo json_encode(["error" => "Gagal mengunggah file"]);
            exit;
        }
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Ekstensi file tidak diizinkan. Gunakan jpg, jpeg, atau png"]);
        exit;
    }
}

// Validasi dasar
if (empty($name) || empty($email) || empty($password)) {
    http_response_code(400);
    echo json_encode(["error" => "Name, email, dan password wajib diisi"]);
    exit;
}

// Insert ke database
$query = "INSERT INTO tb_users (name, email, password, role_id, profile_image) VALUES ('$name', '$email', '$password', " . ($role_id ? $role_id : "NULL") . ", " . ($profile_image ? "'$profile_image'" : "NULL") . ")";
if (mysqli_query($conn, $query)) {
    $id = mysqli_insert_id($conn);
    http_response_code(201);
    echo json_encode(["id" => $id, "name" => $name, "email" => $email]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Gagal menambah user: " . mysqli_error($conn)]);
}

mysqli_close($conn);
?>