<?php
require_once __DIR__ . '../../../../config/db.php';



$book_id = isset($_GET['book_id']) ? (int)$_GET['book_id'] : null;
if ($book_id === null) {
    echo "ID buku tidak ditemukan.";
    exit;
}

try {
    $database = new Database();
    $pdo = $database->connect();

    $query = "DELETE FROM books WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $book_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Buku berhasil dihapus.";
        header("Location: /public/admin/books");
    } else {
        echo "Gagal menghapus buku atau Anda tidak memiliki izin.";
    }
} catch (PDOException $e) {
    echo "Gagal menghapus buku: " . $e->getMessage();
}
?>
