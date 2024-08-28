<?php
include('../includes/baglan.php');

// Form verilerini al ve kontrol et
$name = isset($_POST['name']) ? $_POST['name'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$phone = isset($_POST['phone']) ? $_POST['phone'] : null;
$message = isset($_POST['message']) ? $_POST['message'] : null;

// SQL sorgusunu hazırla
$sql = "INSERT INTO contact_page (name, mail, phone, message) VALUES (?, ?, ?, ?)";

// SQL sorgusunu çalıştır
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $email, $phone, $message);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}

// Bağlantıyı kapat
$stmt->close();
$conn->close();
?>
