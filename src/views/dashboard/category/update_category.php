<?php
require_once __DIR__ . '../../../../config/db.php';

try {
    $database = new Database();
    $pdo = $database->connect();

    // Fetch the category details for the given category_id
    if (isset($_GET['category_id'])) {
        $categoryId = (int)$_GET['category_id'];

        $query = "SELECT * FROM categories WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$categoryId]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Handle the update operation
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_category'])) {
        $name = htmlspecialchars($_POST['name']);
        $categoryId = (int)$_POST['category_id'];

        $query = "UPDATE categories SET name = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$name, $categoryId]);
        header("Location: /public/admin/category");

        echo "<div class='bg-green-500 text-white p-3 rounded-md'>Kategori berhasil diperbarui!</div>";
    }

} catch (PDOException $e) {
    echo "Gagal mengambil data kategori: " . $e->getMessage();
}
?>

<link rel="stylesheet" href="../../../../css/tailwind.css">
<?php include "../src/views/dashboard/sidebar.php" ?>

<div class="p-4 sm:ml-64 h-full">
    <div class="p-3 py-0 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <div class="flex h-full container mx-auto p-4">
            <div class="w-full md:w-1/2 bg-white pr-6 flex flex-col">
                <h1 class="text-3xl font-bold mb-6 w-full bg-slate-950 text-white p-5 rounded-lg">Update Category</h1>

                <form method="POST" class="flex flex-col">
                    <input type="hidden" name="category_id" value="<?= $category['id'] ?>">
                    <label for="name" class="mb-2 text-lg font-semibold">Category Name:</label>
                    <input type="text" name="name" id="name" value="<?= htmlspecialchars($category['name']) ?>" required
                           class="form-input border border-slate-500 rounded-md shadow-sm py-2 px-3 mb-4">
                    <button type="submit" name="update_category"
                            class="bg-green-500 text-white py-2 px-4 rounded-md hover:bg-green-600">
                        Update Category
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
