<?php
// Assuming you have a Database connection class
require_once __DIR__ . '../../../../config/db.php';

try {
    $database = new Database();
    $pdo = $database->connect();

    $query = "
        SELECT 
            c.id, 
            c.name AS category_name, 
            COUNT(b.id) AS book_count 
        FROM 
            categories c 
        LEFT JOIN 
            books b 
        ON 
            c.name = b.kategori 
        GROUP BY 
            c.id, c.name
    ";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Failed to fetch categories: " . $e->getMessage();
}
?>

<link rel="stylesheet" href="../../../../css/tailwind.css">
<?php include "../src/views/dashboard/sidebar.php" ?>

<div class="p-4 sm:ml-64 h-full">
    <div class="p-3 py-0 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <div class="container mx-auto p-2 h-full">
            <div class="flex justify-between bg-gradient-to-r from-slate-900 to-gray-800 items-center p-4 rounded-lg mb-3">
                <h1 class="text-3xl font-bold text-white">List Categories</h1>
                <a href="/public/admin/add-category">
                    <button class="bg-gradient-to-r from-green-500 to-green-700 rounded-lg shadow-md p-2 px-5 text-white font-bold text-lg hover:from-green-700 hover:to-green-900 transition-colors duration-300">
                        Add Category
                    </button>
                </a>
            </div>

            <ul class="list-none space-y-6">
                <?php foreach ($categories as $category): ?>
                    <li class="bg-white shadow-lg p-4 flex items-start space-x-6 border border-slate-300 rounded-lg transform hover:scale-105 transition-transform duration-300">
                        <div class="flex-1">
                            <h2 class="text-2xl font-semibold mb-3 text-gray-800"><?php echo htmlspecialchars($category['category_name']); ?></h2>
                            <p class="text-gray-600"><strong>Books:</strong> <?php echo htmlspecialchars($category['book_count']); ?></p>
                        </div>

                        <div class="flex space-x-3">
                            <!-- Update Button -->
                            <a href="/public/admin/update-category?category_id=<?= $category['id']; ?>" class="bg-yellow-500 p-2 px-4 rounded-lg text-white font-bold shadow-md hover:bg-yellow-600 transition-colors duration-300">
                                Update
                            </a>

                            <!-- Delete Button -->
                            <form action="/public/admin/delete-category" method="GET" class="inline-block">
                                <input type="hidden" name="category_id" value="<?= $category['id']; ?>">
                                <button type="submit" class="bg-red-500 p-2 px-4 rounded-lg text-white font-bold shadow-md hover:bg-red-600 transition-colors duration-300" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
