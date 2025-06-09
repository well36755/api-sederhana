<?php
require_once "config.php";

// Inisialisasi ID
$id = 0;

// Cek method request
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'DELETE') {
    // Untuk DELETE request, baca raw input
    $deleteData = file_get_contents("php://input");
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
    
    if (strpos($contentType, 'application/json') !== false) {
        // Parse JSON data
        $data = json_decode($deleteData, true);
        if ($data && isset($data["id"])) {
            $id = (int)$data["id"];
        }
    } elseif (strpos($contentType, 'multipart/form-data') !== false) {
        // Parse multipart data untuk DELETE request
        $boundary = substr($contentType, strpos($contentType, 'boundary=') + 9);
        $parts = explode('--' . $boundary, $deleteData);
        
        foreach ($parts as $part) {
            if (strpos($part, 'Content-Disposition: form-data') !== false && strpos($part, 'name="id"') !== false) {
                // Get field value
                $fieldValue = trim(substr($part, strpos($part, "\r\n\r\n") + 4));
                $fieldValue = rtrim($fieldValue, "\r\n");
                $id = (int)$fieldValue;
                break;
            }
        }
    } else {
        // Parse form-urlencoded data atau URL parameters
        if (!empty($deleteData)) {
            parse_str($deleteData, $data);
            if (isset($data["id"])) {
                $id = (int)$data["id"];
            }
        }
        
        // Jika tidak ada di body, cek URL parameters
        if ($id <= 0 && isset($_GET["id"])) {
            $id = (int)$_GET["id"];
        }
    }
} else {
    // Untuk POST request (fallback)
    $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;
    
    // Jika tidak ada di POST, cek GET parameters
    if ($id <= 0 && isset($_GET["id"])) {
        $id = (int)$_GET["id"];
    }
}

// Validasi ID
if ($id <= 0) {
    http_response_code(400);
    echo json_encode([
        "error" => "ID diperlukan dan harus valid",
        "debug" => [
            "method" => $method,
            "received_id" => $id,
            "content_type" => $_SERVER['CONTENT_TYPE'] ?? 'not set',
            "raw_input" => file_get_contents("php://input"),
            "get_params" => $_GET,
            "post_params" => $_POST
        ]
    ]);
    exit;
}

// Gunakan prepared statement untuk keamanan
$stmt = $conn->prepare("DELETE FROM tb_users WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute() && $stmt->affected_rows > 0) {
    echo json_encode(["message" => "User berhasil dihapus"]);
} else {
    http_response_code(404);
    echo json_encode(["error" => "User tidak ditemukan"]);
}

$stmt->close();
mysqli_close($conn);
?>