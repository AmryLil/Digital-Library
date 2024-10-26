<?php
require_once __DIR__ . '../../../../config/db.php';

try {
    $database = new Database();
    $pdo = $database->connect();

    // Handle the delete operation
    if (isset($_GET['category_id'])) {
        $categoryId = (int)$_GET['category_id'];

        $query = "DELETE FROM categories WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$categoryId]);
        header("Location: /public/admin/category");

        exit;
    } else {
        // If no category_id is provided, redirect back to the list page
        header("Location: list-categories.php");
        exit;
    }

} catch (PDOException $e) {
    echo "Gagal menghapus kategori: " . $e->getMessage();
}
?>
