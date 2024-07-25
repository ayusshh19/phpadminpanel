<?php
include "../index.php";
$parts = parse_url($_SERVER['REQUEST_URI']);
$current = "";
if (isset($parts['query'])) {
    parse_str($parts['query'], $query);
    if (isset($query['error'])) {
        $current = $query['error'];
    }
}
if (isset($_COOKIE["rememberme"])) {
    session_start();
    $result = $userobj->tokenbasedlogin();
    $_SESSION["user"] = $result;
    print_r($result);
    if (isset($result)) {
        header("Location:admin.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>

<body class="bg-gray">
    <?php if($current):?>
        <div class="bg-red-100 border fixed top-0 border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Login Error!</strong>
        <span class="block sm:inline"><?php echo $current;?></span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <title>Close</title>
                <path
                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </span>
    </div>
    <?php endif;?>
    <div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-950">
        <div class="bg-white dark:bg-gray-900 shadow-md rounded-lg px-8 py-6 max-w-md">
            <h1 class="text-2xl font-bold text-center mb-4 dark:text-gray-200">Welcome Back!</h1>
            <form action="../controller/Auth.php" method="post">
                <div class="mb-4">
                    <label for="email"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Username</label>
                    <input type="text" id="username" name="username"
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Enter Your username" required>
                </div>
                <div class="mb-4">
                    <label for="password"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                    <input type="password" id="password" name="password"
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Enter your password" required>
                    <a href="resetpassword.php"
                        class="text-xs text-gray-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Forgot
                        Password?</a>
                </div>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 focus:outline-none"
                            checked>
                        <label for="remember" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Remember
                            me</label>
                    </div>
                    <a href="signup.php"
                        class="text-xs text-indigo-500 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create
                        Account</a>
                </div>
                <button type="submit" name="login"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</button>
            </form>
        </div>
    </div>
</body>

</html>