<?php
ini_set('max_execution_time', 300); // Set waktu eksekusi maksimum menjadi 300 detik (5 menit)

require_once __DIR__ . '/../config/db.php';

function getBookDataFromOpenLibrary($isbn) {
    $url = "https://openlibrary.org/api/books?bibkeys=ISBN:$isbn&format=json&jscmd=data";
    $json = @file_get_contents($url);
    
    if ($json === FALSE) {
        echo "Gagal mendapatkan data dari API untuk ISBN: $isbn<br>";
        return null;
    }

    $bookData = json_decode($json, true);
    
    if (isset($bookData["ISBN:$isbn"])) {
        $bookInfo = $bookData["ISBN:$isbn"];
        $coverUrl = $bookInfo['cover']['large'] ?? $bookInfo['cover']['medium'] ?? null;

        // Hanya mengembalikan data jika ada cover
        if ($coverUrl) {
            return [
                'title' => $bookInfo['title'] ?? 'No Title',
                'description' => $bookInfo['notes'] ?? 'No Description',
                'categories' => $bookInfo['subjects'][0]['name'] ?? 'Unknown',
                'cover' => $coverUrl,
            ];
        }
    }

    return null;
}

function saveBooksToDatabase($pdo, $booksData) {
    if ($pdo === null) {
        echo "Database connection is not available.<br>";
        return;
    }
    
    $query = "INSERT INTO books (judul, kategori, deskripsi, jumlah, pdf, cover) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    
    try {
        $pdo->beginTransaction();
        foreach ($booksData as $bookData) {
            if ($bookData['cover']) {
                $judul = htmlspecialchars($bookData['title']);
                $kategori = htmlspecialchars($bookData['categories']);
                $deskripsi = htmlspecialchars($bookData['description']);
                $jumlah = 1; 
                $cover = htmlspecialchars($bookData['cover']);
                $pdf = null; 

                $stmt->execute([$judul, $kategori, $deskripsi, $jumlah, $pdf, $cover]);
            }
        }
        $pdo->commit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Gagal menyimpan data buku ke database: " . $e->getMessage() . "<br>";
    }
}

try {
    $database = new Database();
    $pdo = $database->connect();
} catch (PDOException $e) {
    die("Gagal terhubung ke database: " . $e->getMessage());
}

// Daftar ISBN untuk mengambil data buku dari berbagai kategori
$isbnList = [
    // Fiksi
    '9780743273565', '9780439064873', '9780316769488', '9780316015844', '9780553380163',
    '9780451526342', '9780061120084', '9780143039433', '9780141441146', '9780141439600',

    // Non-Fiksi
    '9780307277671', '9780679720201', '9780375725603', '9780451524935', '9780385474542',
    '9780385490813', '9780307387897', '9780812981605', '9780307387941', '9780679600114',

    // Sejarah
    '9780307588364', '9780679785897', '9780385492515', '9780307387880', '9780553382563',

    // Biografi
    '9780812993547', '9780316017923', '9781400033416', '9780670020553', '9780307474726',

    // Fantasi
    '9780545010221', '9780345538376', '9780618260300', '9780060853983', '9780156012195',

    // Anak-anak
    '9780064404990', '9780375831003', '9780060256654', '9780394800165', '9780060254926',

    // Self-Help
    '9780743273565', '9780671027032', '9781594206146', '9780345538376', '9780062316110',

    // Misteri/Thriller
    '9780062073488', '9780385490813', '9780307474278', '9780525952250', '9780062856625',

    // Fiksi Ilmiah
    '9780441172715', '9780312863555', '9780553380163', '9780345404473', '9780345391804',
];

$booksData = [];
foreach ($isbnList as $isbn) {
    $bookData = getBookDataFromOpenLibrary($isbn);

    if ($bookData) {
        $booksData[] = $bookData;
        echo "Buku dengan ISBN $isbn berhasil ditemukan dan memiliki cover.<br>";
    } else {
        echo "Data buku dengan ISBN $isbn tidak ditemukan di API atau tidak memiliki cover.<br>";
    }
}

if (!empty($booksData)) {
    saveBooksToDatabase($pdo, $booksData);
    echo "Semua buku yang memiliki cover berhasil disimpan ke database.<br>";
}
?>
