<?php
require_once __DIR__ . '/../config/db.php';

// Pastikan user sudah login
$user_id = isset($_SESSION['user']['id']) ? (int)$_SESSION['user']['id'] : null;

if ($user_id === null) {
    echo "User ID tidak ditemukan. Pastikan Anda sudah login.";
    exit;
}

try {
    $database = new Database();
    $pdo = $database->connect();
} catch (PDOException $e) {
    die("Gagal terhubung ke database: " . $e->getMessage());
}

// Ambil daftar buku milik user
$query = "SELECT * FROM books WHERE user_id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mx-auto p-6 mt-16 h-screen">
    <div class="flex justify-between bg-black items-center p-4 rounded-lg mb-3">
        <h1 class="text-3xl font-bold text-white">My Books</h1>
        <a href="/public/add-book">
            <button class="bg-white rounded-lg shadow-sm p-1 px-4 text-slate-950 font-bold text-lg">Add Book</button>
        </a>
    </div>
    <ul class="list-none space-y-4">
        <?php foreach ($books as $book): ?>
            <li class="bg-white shadow-md p-3 flex items-start space-x-4 border border-slate-400 rounded-lg hover:bg-gray-950 hover:text-white transition-all duration-200">
                <img src="<?php echo htmlspecialchars($book['cover']); ?>" alt="Cover" class="w-32 h-48 object-cover rounded-md">
                <div class="flex-1">
                    <h2 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($book['judul']); ?></h2>
                    <p class="mb-2"><strong>Kategori:</strong> <?php echo htmlspecialchars($book['kategori']); ?></p>
                    <p class="mb-4"><?php echo htmlspecialchars($book['deskripsi']); ?></p>
                    <p><strong>Jumlah:</strong> <?php echo htmlspecialchars($book['jumlah']); ?></p>
                </div>

                <!-- Tombol Update -->
                <form action="/public/update-book" method="GET" class="inline-block">
                    <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                    <button type="submit" class="bg-yellow-600 p-1 px-3 text-base rounded-lg text-white font-bold">Update</button>
                </form>

                <!-- Tombol Delete -->
                <form action="/public/delete-book" method="GET" class="inline-block">
                    <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                    <button type="submit" class="bg-red-600 p-1 px-3 text-base rounded-lg text-white font-bold" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
