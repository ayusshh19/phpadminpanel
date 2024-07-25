<?php
session_start();
$register_error = "";
if (isset($_SESSION["reg_error_message"])) {
    $register_error = $_SESSION["reg_error_message"];
    unset($_SESSION["reg_error_message"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>SignUp</title>
    <style>
        .valid {
            color: green !important;
        }

        .error-message {
            color: red;
        }
    </style>
</head>

<body class="bg-gray">
    <?php if ($register_error): ?>
        <div class="bg-red-100 border fixed top-0 border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Signup Error!</strong>
            <span class="block sm:inline"><?php echo $register_error; ?></span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </span>
        </div>
    <?php endif; ?>
    <div class="min-h-screen flex items-center flex-wrap justify-center w-full dark:bg-gray-950">
        <div class="bg-white shadow-xl  rounded-lg px-8 py-6 max-w-md">
            <h1 class="text-2xl font-bold text-center mb-4 dark:text-gray-200">Create New Account</h1>
            <form action="../controller/Auth.php" method="post" enctype="multipart/form-data">
                <div class="mb-1">
                    <div class="flex gap-2">
                        <div class="firstname"><label for="firstname"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Firstname</label>
                            <input type="text" name="firstname" id="firstname"
                                class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Enter your Firstname" required>
                        </div>
                        <div class="lastname"><label for="lastname"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Lastname</label>
                            <input type="text" name="lastname" id="lastname"
                                class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Enter your Lastname" required>
                        </div>
                    </div>

                </div>
                <div class="mb-1">
                    <label for="username"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Username</label>
                    <input type="text" id="username" name="username"
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Enter your username" required>
                </div>
                <div class="mb-1">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email
                        Address</label>
                    <input type="email" id="email" name="email"
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="your@email.com" required>
                </div>
                <div class="mb-1">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Profile
                        Photo</label>
                    <label for="file-input" class="sr-only">Upload</label>
                    <input type="file" name="profilephoto" id="file-input" class="block w-full border border-gray-200 shadow-sm cursor-pointer rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
                    file:bg-gray-50 file:border-0
                    file:me-4
                    file:py-3 file:px-4
                    dark:file:bg-neutral-700 dark:file:text-neutral-400">
                </div>
                <div class="mb-4">
                    <label for="password"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                    <input type="password" id="password" name="password"
                        class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Enter your password" required>
                </div>
                <button type="submit" id="register" name="register"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Sign
                    Up</button>
            </form>
        </div>
        <div class="hidden xl:inline-block h-[400px] mx-10 min-h-[1em] w-0.5  bg-black/10"></div>
        <div
            class=" bg-white shadow-md p-5 m-5 w-full xl:w-auto xl:mt-5 flex-col justify-center items-center md:w-auto rounded-lg ">
            <div id="usernameerror">
                <h1 class="text-2xl text-gray-700 my-2">Username requirement : </h1>
                <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                    <li class="flex items-center">
                        <svg class="w-3.5 h-3.5 me-2 text-gray-500 flex-shrink-0" id="usernamelengthError"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        Must be at least 6 characters long.
                    </li>
                    <li class="flex items-center">
                        <svg class="w-3.5 h-3.5 me-2 text-gray-500 flex-shrink-0" id="usernamenumberError"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        Must contain a number.
                    </li>
                </ul>
            </div>
            <div id="passworderror">
                <hr class="my-2 h-0.5 border-t-0 bg-neutral-200 dark:bg-white/10" />
                <h1 class="text-2xl text-gray-700 my-2">Password requirement : </h1>
                <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
                    <li class="flex items-center">
                        <svg class="w-3.5 h-3.5 me-2 text-gray-500 flex-shrink-0" aria-hidden="true" id="lengthError"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        Must be at least 6 characters long.
                    </li>
                    <li class="flex items-center">
                        <svg class="w-3.5 h-3.5 me-2 text-gray-500 flex-shrink-0" aria-hidden="true" id="uppercaseError"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        Must contain an uppercase letter.
                    </li>
                    <li class="flex items-center">
                        <svg class="w-3.5 h-3.5 me-2 text-gray-500 dark:text-gray-400 flex-shrink-0" aria-hidden="true"
                            id="lowercaseError" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        Must contain a lowercase letter.
                    </li>
                    <li class="flex items-center">
                        <svg class="w-3.5 h-3.5 me-2 text-gray-500 dark:text-gray-400 flex-shrink-0" aria-hidden="true"
                            id="numberError" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        Must contain a number.
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script src="../public/js/formvalidation.js"></script>
</body>

</html>