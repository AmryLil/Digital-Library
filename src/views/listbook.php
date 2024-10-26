<?php
require_once __DIR__ . '/../config/db.php';

// Get the selected category from the query string
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';

// Create a database connection
try {
    $database = new Database();
    $pdo = $database->connect();
} catch (PDOException $e) {
    die("Gagal terhubung ke database: " . $e->getMessage());
}

// Fetch distinct categories for the filter
$categoryQuery = "SELECT DISTINCT kategori FROM books";
$categories = $pdo->query($categoryQuery)->fetchAll(PDO::FETCH_COLUMN);

// Prepare the query to fetch books
$query = "SELECT * FROM books";
if ($selectedCategory) {
    $query .= " WHERE kategori = ?";
}
$stmt = $pdo->prepare($query);

if ($selectedCategory) {
    $stmt->execute([$selectedCategory]);
} else {
    $stmt->execute();
}

$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <link href="../../css/tailwind.css"rel="stylesheet">
</head>
<body class="bg-gray-100">


<div class="container mx-auto p-4 mt-16">
    <!-- Filter Form -->
    <form method="GET" action="" class="mb-4 flex justify-between">
      <h1 class="text-2xl font-bold">List Books</h1>
      <div class="">
        <select id="category" name="category" onchange="this.form.submit()"
                  class="form-select block w-full mt-1 border-gray-300 rounded-md shadow-sm">
              <option value="">All Categories</option>
              <?php foreach ($categories as $category): ?>
                  <option value="<?php echo htmlspecialchars($category); ?>"
                      <?php if ($selectedCategory === $category) echo 'selected'; ?>>
                      <?php echo htmlspecialchars($category); ?>
                  </option>
              <?php endforeach; ?>
        </select>
      </div>
    </form>

    <!-- Books List -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <?php if ($books): ?>
            <?php foreach ($books as $book): ?>
                <div class="bg-slate-950 p-2 rounded-lg shadow-md text-slate-50">
                    <?php if ($book['cover']): ?>
                        <img src="<?php echo htmlspecialchars($book['cover']); ?>" alt="Cover"
                             class="w-full h-[70vh] object-cover rounded-lg mb-2">
                    <?php endif; ?>
                    <h2 class="text-lg font-bold mb-1"><?php echo htmlspecialchars($book['judul']); ?></h2>
                    <!-- <p class="text-gray-600 mb-2"><?php echo htmlspecialchars($book['deskripsi']); ?></p> -->
                    <span class="block text-gray-500"><?php echo htmlspecialchars($book['kategori']); ?></span>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center col-span-full text-gray-600">No books found.</p>
        <?php endif; ?>
    </div>

</div>
</body>
</html>
