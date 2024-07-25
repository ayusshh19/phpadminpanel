<?php 
include "../index.php";

if(isset($_POST["updatepo"])){
    include "../utils/helper.php";
    $sql = "TRUNCATE TABLE translations";
    $conn->exec($sql);
    $poFiles = traverseDirectory("../public/locale/");
    foreach ($poFiles as $filePath) {
        $language = basename(dirname($filePath));
        $translations = parsePOFile($filePath);
        storeTranslationsInDB($translations, $language, $conn);
    }
    header("Location:../view/admin.php");
}
