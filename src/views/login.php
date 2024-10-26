<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="../../css/tailwind.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- component -->
    <div class="flex h-screen">
        <!-- Left Pane -->
        <div class="hidden lg:flex items-center justify-center flex-1 bg-white text-black">
            <div class="max-w-md text-center">
                <img src="../../public/images/login.png" alt="">
                <h1 class="font-bold text-3xl -translate-y-5">DIGITAL LIBRARY</h1>
            </div>
        </div>

        <!-- Right Pane -->
        <div class="w-full bg-gray-100 lg:w-1/2 flex items-center justify-center">
            <div class="max-w-md w-full p-6">
                <h1 class="text-3xl font-semibold mb-6 text-black text-center">Login</h1>
                <h1 class="text-sm font-semibold mb-6 text-gray-500 text-center">Join to Our Community with all time access and free </h1>

                <form action="../src/controller/LoginController.php" method="POST" class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="email" name="username" class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password" class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                        <select id="role" name="role" class="mt-1 p-2 w-full border rounded-md focus:border-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 transition-colors duration-300">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    
                    <div>
                        <button type="submit" name="login" class="w-full bg-black text-white p-2 rounded-md hover:bg-gray-800 focus:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors duration-300">Login</button>
                    </div>
                </form>
                <div class="mt-4 text-sm text-gray-600 text-center">
                    <p>Don't have an account? <a href="/public/signup" class="text-black hover:underline">Signup</a></p>
                </div>
            </div>
            
        </div>
    </div>
</body>

</html>
