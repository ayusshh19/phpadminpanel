<?php

function Connectdatabase()
{
    try {
        $server = "localhost";
        $user = "root";
        $password = "ayusshh19";
        $database = "emptask";

        $conn = new PDO("mysql:host=$server;dbname=$database", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        
        return $conn;
    } catch (\Throwable $th) {
        echo " ERROR : " . $th;
    }
}
