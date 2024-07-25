<?php
require_once "../index.php";

session_start();
$profilephoto = $_SESSION["user"]["profile_photo"];
$username = $_SESSION["user"]["username"];
$role = $_SESSION["user"]["role"];
$parts = parse_url($_SERVER['REQUEST_URI']);
$current = "Userdisplay";
$cache_filepath = "../cache/index.cache.php";
$lang = "en_US";
$translated;


if (isset($_GET["lang"])) {
    try {
        $lang = $_GET["lang"];
        $id = $_SESSION["user"]['id'];
        $getlanguagequery = "select * from user_translate where user_id = $id and lang = '$lang'";
        $stmt = $conn->prepare($getlanguagequery);
        $stmt->execute();
        $result = $stmt->fetch();
        $_SESSION["user"]["name"] = $result["name"];
    } catch (\Throwable $th) {
        logMessage("error","{$th->getMessage()} file name {$th->getFile()} line no {$th->getLine()}", "../logs/error_log.txt");
    }

}

if (file_exists($cache_filepath) && filesize($cache_filepath) > 0) {

    try {
        $json_data = file_get_contents($cache_filepath);
        $translated = json_decode($json_data, true)[$lang];
    } catch (\Throwable $th) {
        logMessage("error","{$th->getMessage()} file name {$th->getFile()} line no {$th->getLine()}", "../logs/error_log.txt");
    }

} else {

    try {
        include "../utils/helper.php";
        $sql = "TRUNCATE TABLE translations";
        $conn->exec($sql);
        $poFiles = traverseDirectory("../public/locale/");
        foreach ($poFiles as $filePath) {
            $language = basename(dirname($filePath));
            $translations = parsePOFile($filePath);
            storeTranslationsInDB($translations, $language, $conn);
        }

        $gettranslation = $userobj->getalltranslations();
        print_r($gettranslation);
        $handle = fopen($cache_filepath, "w");
        fwrite($handle, json_encode($gettranslation, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $translated = $gettranslation[$lang];
    } catch (\Throwable $th) {
        logMessage("error","{$th->getMessage()} file name {$th->getFile()} line no {$th->getLine()}", "../logs/error_log.txt");
    }
}

try {
    if (isset($parts['query'])) {
        parse_str($parts['query'], $query);
        if (isset($query['current'])) {
            $current = $query['current'];
        }
    }

} catch (\Throwable $th) {
    logMessage("error","{$th->getMessage()} file name {$th->getFile()} line no {$th->getLine()}", "../logs/error_log.txt");
}


include ("../public/lang/" . $lang . ".php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?php echo $username; ?></title>
</head>

<body>


    <?php include "../utils/sidebar.php" ?>


    <?php if ($_SESSION["user"]["role"] == "admin" and $current == "admindisplay"): ?>
        <?php include ("admindisplay.php"); ?>
    <?php else: ?>
        <?php include ("Userdisplay.php") ?>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    <script>
        function change_lang(value) {
            window.location.replace("?lang=" + value);
        }
    </script>
</body>

</html>