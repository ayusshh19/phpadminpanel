<?php

function parsePOFile($filePath)
{
    $translations = [];
    $handle = fopen($filePath, "r");
    if ($handle) {
        $msgid = $msgstr = '';
        while (($line = fgets($handle)) !== false) {
            $line = trim($line);
            if (strpos($line, 'msgid "') === 0) {
                $msgid = substr($line, 7, -1);
            } elseif (strpos($line, 'msgstr "') === 0) {
                $msgstr = substr($line, 8, -1);
                $translations[$msgid] = $msgstr;
            }
        }
        fclose($handle);
    }
    return $translations;
}

function traverseDirectory($dir)
{
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    $poFiles = [];
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'po') {
            $poFiles[] = $file->getPathname();
        }
    }
    return $poFiles;
}


function storeTranslationsInDB($translations, $language, $pdo)
{ 

    foreach ($translations as $msgid => $msgstr) {
        $stmt = $pdo->prepare("INSERT INTO translations (language, msgid, msgstr) VALUES (:language, :msgid, :msgstr)");
        $stmt->execute([':language' => $language, ':msgid' => $msgid, ':msgstr' => $msgstr]);
    }
    
}
