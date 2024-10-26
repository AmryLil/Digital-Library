<?php
require_once __DIR__ . '../../../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_category'])) {
    try {
        $database = new Database();
        $pdo = $database->connect();

        $name = htmlspecialchars($_POST['name']);
        $query = "INSERT INTO categories (name) VALUES (?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$name]);

        echo "Kategori berhasil ditambahkan!";
        header("Location: /public/admin/category");

    } catch (PDOException $e) {
        echo "Gagal menambahkan kategori: " . $e->getMessage();
    }
}
?>
<link rel="stylesheet" href="../../../../css/tailwind.css">
<?php include "../src/views/dashboard/sidebar.php" ?>

<div class="p-4 sm:ml-64 h-full">
    <div class="p-3 py-0 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <div class="flex h-full container mx-auto p-4">
            <div class="w-full md:w-1/2 bg-white pr-6 flex flex-col">
                <h1 class="text-3xl font-bold mb-6 w-full bg-slate-950 text-white p-5 rounded-lg">Add New Category</h1>

                <form method="POST" class="space-y-4 px-5">
                    <div>
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Category Name:</label>
                        <input type="text" id="name" name="name" required
                               class="form-input block w-full border border-slate-500 rounded-md shadow-sm py-2 px-3">
                    </div>
                    <button type="submit" name="create_category"
                            class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                        Add Category
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
