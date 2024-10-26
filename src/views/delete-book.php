<?php
require_once __DIR__ . '/../config/db.php';

// Pastikan user sudah login
$user_id = isset($_SESSION['user']['id']) ? (int)$_SESSION['user']['id'] : null;
if ($user_id === null) {
    echo "User ID tidak ditemukan. Pastikan Anda sudah login.";
    exit;
}

// Ambil ID buku dari query string
$book_id = isset($_GET['book_id']) ? (int)$_GET['book_id'] : null;
if ($book_id === null) {
    echo "ID buku tidak ditemukan.";
    exit;
}

// Hapus buku berdasarkan ID
try {
    $database = new Database();
    $pdo = $database->connect();

    $query = "DELETE FROM books WHERE id = :id AND user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $book_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        header("Location: /public/my-books");
        echo "Buku berhasil dihapus.";
    } else {
        echo "Gagal menghapus buku atau Anda tidak memiliki izin.";
    }
} catch (PDOException $e) {
    echo "Gagal menghapus buku: " . $e->getMessage();
}
?>
