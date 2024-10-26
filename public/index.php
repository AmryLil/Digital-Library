<?php
session_start();

// Ambil URI tanpa query string (seperti ?id=1)
$uri = str_replace('/public', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Tangkap parameter `id` jika ada
$id = isset($_GET['book_id']) ? (int)$_GET['book_id'] : null;
$id_category = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;

// Tentukan rute yang akan dimuat
switch ($uri) {
    case '/':
    case '/index.php':
        $page = '../src/views/home.php';
        break;
    case '/login':
        $page = '../src/views/login.php';
        break;
    case '/logout':
        $page = '../src/views/logout.php';
        break;
    case '/signup': // Pastikan ada case untuk signup
        $page = '../src/views/singup.php'; // Sesuaikan dengan path signup Anda
        break;
    case '/list-books':
        $page = '../src/views/listbook.php';
        break;
    case '/category':
        $page = '../src/views/category.php';
        break;
    case '/my-books':
        $page = '../src/views/my-books.php';
        break;
    case '/update-book':
        if ($id !== null) {
            $page = '../src/views/update-book.php';
        } else {
            $page = '../src/views/404.php';
        }
        break;
    case '/delete-book':
        if ($id !== null) {
            $page = '../src/views/delete-book.php';
        } else {
            $page = '../src/views/404.php';
        }
        break;
    case '/contact':
        $page = '../src/views/contact.php';
        break;
    case '/add-book':
        $page = '../src/views/formbook.php';
        break;
    case '/admin':
        $page = '../src/views/dashboard/admin_dashboard.php';
        break;
    case '/admin/books':
        $page = '../src/views/dashboard/books/index.php';
        break;
    case '/admin/logout':
        $page = '../src/views/dashboard/logout.php';
        break;
    case '/admin/category':
        $page = '../src/views/dashboard/category/list_category.php';
        break;
    case '/admin/add-category':
        $page = '../src/views/dashboard/category/add_category.php';
        break;
        
    case '/admin/update-category':
        if ($id_category !== null) {
            $page = '../src/views/dashboard/category/update_category.php';
        } else {
            $page = '../src/views/404.php';
        }
        break;
    case '/admin/delete-category':
        if ($id_category !== null) {
            $page = '../src/views/dashboard/category/delete_category.php';
        } else {
            $page = '../src/views/404.php';
        }
        break;

    case '/admin/add-book':
        $page = '../src/views/dashboard/books/add_book.php';
        break;
    case '/admin/update-book':
        if ($id !== null) {
            $page = '../src/views/dashboard/books/update_book.php';
        } else {
            $page = '../src/views/404.php';
        }
        break;
    case '/admin/delete-book':
        if ($id !== null) {
            $page = '../src/views/dashboard/books/delete_book.php';
        } else {
            $page = '../src/views/404.php';
        }
        break;
    
    default:
        // Tampilkan halaman 404 jika rute tidak ditemukan
        $page = '../src/views/404.php';
        break;
}

// Tentukan apakah menampilkan navbar dan footer
$showNavbarFooter = !preg_match('/^\/(admin|login|signup)/', $uri);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../css/tailwind.css" rel="stylesheet">
  <title>Digital Library</title>
</head>
<body>

  <?php if ($showNavbarFooter) include "../src/components/navbar.php"; ?>
  <main class="h-max ">
    <?php include $page ?>
  </main>
  <?php if ($showNavbarFooter) include "../src/components/footer.php"; ?>
  
</body>
</html>
