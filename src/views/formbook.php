<?php
// session_start(); // Memulai session

require_once __DIR__ . '/../config/db.php';

// Ambil ID pengguna dari session
$userId = isset($_SESSION['user']['id']) ? (int)$_SESSION['user']['id'] : null;

if ($userId === null) {
    echo "User ID tidak ditemukan. Pastikan Anda sudah login.";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $category = htmlspecialchars($_POST['category']);
    $description = htmlspecialchars($_POST['description']);
    $quantity = (int)$_POST['quantity'];
    $cover = null;
    $pdf = null;

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

    // Insert data into the database
    try {
        $database = new Database();
        $pdo = $database->connect();

        $query = "INSERT INTO books (judul, kategori, deskripsi, jumlah, pdf, cover, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        
        $stmt->execute([$title, $category, $description, $quantity, $pdf, $cover, $userId]);

        echo "Buku berhasil ditambahkan!<br>";
        header("Location: /public/my-books");

    } catch (PDOException $e) {
        echo "Gagal menambahkan buku ke database: " . $e->getMessage() . "<br>";
    }
}
?>

<div class="flex h-full container mx-auto p-4 mt-16">
    <!-- Form Container -->
    <div class="w-full md:w-1/2 bg-white pr-6 flex flex-col ">
        <h1 class="text-3xl font-bold mb-6 w-full bg-slate-950 text-white p-5 rounded-lg">Add New Book</h1>

        <form id="bookForm" method="POST" enctype="multipart/form-data" class="space-y-4 px-5">
            <div>
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
                <input type="text" id="title" name="title" required
                       class="form-input block w-full border border-slate-500 rounded-md shadow-sm py-2 px-3">
            </div>

            <div>
                <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
                <select id="category" name="category" required
                        class="form-select block w-full border border-slate-500 rounded-md shadow-sm py-2 px-3">
                        <option value="">Select a category</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Non-Fiction">Non-Fiction</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Romance">Romance</option>
                    <option value="Mystery">Mystery</option>
                    <option value="Thriller">Thriller</option>
                    <option value="History">History</option>
                    <option value="Science">Science</option>
                    <option value="Technology">Technology</option>
                    <option value="Education">Education</option>
                    <!-- Add your categories here -->
                </select>
            </div>

            <div>
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
                <textarea id="description" name="description" rows="4" required
                          class="form-textarea block w-full border border-slate-500 rounded-md shadow-sm py-2 px-3"></textarea>
            </div>

            <div>
                <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity:</label>
                <input type="number" id="quantity" name="quantity" required min="1"
                       class="form-input block w-full border border-slate-500 rounded-md shadow-sm py-2 px-3">
            </div>

            <div>
                <label for="cover" class="block text-gray-700 text-sm font-bold mb-2">Cover Image:</label>
                <input type="file" id="cover" name="cover" accept="image/*"
                       class="form-input block w-full border border-slate-500 rounded-md shadow-sm py-2 px-3">
            </div>

            <div>
                <label for="pdf" class="block text-gray-700 text-sm font-bold mb-2">PDF File:</label>
                <input type="file" id="pdf" name="pdf" accept="application/pdf"
                       class="form-input block w-full border border-slate-500 rounded-md shadow-sm py-2 px-3">
            </div>

            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                Add Book
            </button>
        </form>
    </div>

    <!-- Image Placeholder -->
    <div class="hidden md:flex w-full md:w-1/2 bg-gray-100 ">
        <img src="../../public/images/banner2.jpg" alt="Placeholder Image" class="rounded-md shadow-md h-[120vh] w-full object-center">
    </div>
</div>

<!-- Loading Spinner -->
<div id="loading" class="hidden fixed inset-0 bg-black bg-opacity-50 text-white flex items-center justify-center">
    <div class="spinner-border animate-spin border-4 border-t-4 border-white rounded-full w-12 h-12"></div>
</div>

<script>
    // Show loading spinner on form submit
    document.getElementById('bookForm').addEventListener('submit', function() {
        document.getElementById('loading').classList.remove('hidden');
    });
</script>
