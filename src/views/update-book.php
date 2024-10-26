<?php
require_once __DIR__ . '/../config/db.php';

$user_id = isset($_SESSION['user']['id']) ? (int)$_SESSION['user']['id'] : null;

if ($user_id === null) {
    echo "User ID tidak ditemukan. Pastikan Anda sudah login.";
    exit;
}

$bookId = isset($_GET['book_id']) ? (int)$_GET['book_id'] : null;

if ($bookId === null) {
    echo "Book ID tidak ditemukan.";
    exit;
}

try {
    $database = new Database();
    $pdo = $database->connect();
    
    $query = "SELECT * FROM books WHERE id = :book_id AND user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':book_id', $bookId, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$book) {
        echo "Buku tidak ditemukan.";
        exit;
    }
} catch (PDOException $e) {
    die("Gagal mengambil data buku: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $category = htmlspecialchars($_POST['category']);
    $description = htmlspecialchars($_POST['description']);
    $quantity = (int)$_POST['quantity'];
    $cover = $book['cover'];
    $pdf = $book['pdf'];

    // Handle cover image upload
    if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../uploads/covers/';
        $coverFile = basename($_FILES['cover']['name']);
        $uploadFile = $uploadDir . $coverFile;

        if (move_uploaded_file($_FILES['cover']['tmp_name'], $uploadFile)) {
            $cover = $coverFile;
        } else {
            echo "Gagal meng-upload file cover.<br>";
        }
    }

    // Handle PDF upload
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../uploads/pdfs/';
        $pdfFile = basename($_FILES['pdf']['name']);
        $uploadFile = $uploadDir . $pdfFile;

        if (move_uploaded_file($_FILES['pdf']['tmp_name'], $uploadFile)) {
            $pdf = $pdfFile;
        } else {
            echo "Gagal meng-upload file PDF.<br>";
        }
    }

    // Update data in the database
    try {
        $query = "UPDATE books SET judul = ?, kategori = ?, deskripsi = ?, jumlah = ?, cover = ?, pdf = ? WHERE id = ? AND user_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$title, $category, $description, $quantity, $cover, $pdf, $bookId, $user_id]);

        echo "Buku berhasil diperbarui!";
        header("Location: /public/my-books");
        exit;
    } catch (PDOException $e) {
        echo "Gagal memperbarui buku di database: " . $e->getMessage() . "<br>";
    }
}
?>

<div class="container mx-auto p-6 mt-10 flex">
    <div class="w-1/2 pr-4">
    <h1 class="text-3xl font-bold  w-full bg-slate-950 text-white p-5 rounded-lg">Add New Book</h1>

    <form method="POST" enctype="multipart/form-data" class="space-y-4 w-full p-4">
        <div>
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
            <input type="text" id="title" name="title" required value="<?php echo htmlspecialchars($book['judul']); ?>"
                   class="form-input block w-full border border-slate-500 rounded-md shadow-sm py-2 px-3">
        </div>

        <div>
            <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
            <select id="category" name="category" required
                    class="form-select block w-full border border-slate-500 rounded-md shadow-sm py-2 px-3">
                <option value="">Select a category</option>
                <option value="Fiction" <?php echo $book['kategori'] === 'Fiction' ? 'selected' : ''; ?>>Fiction</option>
                <option value="Non-Fiction" <?php echo $book['kategori'] === 'Non-Fiction' ? 'selected' : ''; ?>>Non-Fiction</option>
                <!-- Add more categories here -->
            </select>
        </div>

        <div>
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
            <textarea id="description" name="description" rows="4" required
                      class="form-textarea block w-full border border-slate-500 rounded-md shadow-sm py-2 px-3"><?php echo htmlspecialchars($book['deskripsi']); ?></textarea>
        </div>

        <div>
            <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required min="1" value="<?php echo htmlspecialchars($book['jumlah']); ?>"
                   class="form-input block w-full border border-slate-500 rounded-md shadow-sm py-2 px-3">
        </div>

        <div>
            <label for="cover" class="block text-gray-700 text-sm font-bold mb-2">Cover Image:</label>
            <input type="file" id="cover" name="cover" accept="image/*"
                   class="form-input block w-full border border-slate-500 rounded-md shadow-sm py-2 px-3">
            <?php if ($book['cover']): ?>
                <img src="/uploads/covers/<?php echo htmlspecialchars($book['cover']); ?>" alt="Cover"
                     class="w-32 h-48 object-cover mt-3 rounded-md">
            <?php endif; ?>
        </div>

        <div>
            <label for="pdf" class="block text-gray-700 text-sm font-bold mb-2">PDF:</label>
            <input type="file" id="pdf" name="pdf" accept=".pdf"
                   class="form-input block w-full border border-slate-500 rounded-md shadow-sm py-2 px-3">
            <?php if ($book['pdf']): ?>
                <p class="mt-2">Current PDF: <a href="/uploads/pdfs/<?php echo htmlspecialchars($book['pdf']); ?>" class="text-blue-500 underline"><?php echo htmlspecialchars($book['pdf']); ?></a></p>
            <?php endif; ?>
        </div>

        <div>
            <button type="submit"
                    class="bg-yellow-600 text-white rounded-md py-2 px-4 font-bold">Update Book</button>
        </div>
    </form>
    </div>
    <div class="hidden md:flex w-full md:w-1/2 bg-gray-100 ">
        <img src="../../public/images/banner2.jpg" alt="Placeholder Image" class="rounded-md shadow-md h-[160vh] w-full object-center">
    </div>
</div>
