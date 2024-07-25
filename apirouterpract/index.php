<?php
include "Router.php";
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


$router = new Router();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
function posttest (){
   $input = json_decode(file_get_contents("php://input"),true);
   echo json_encode(['msg' => $input, 'status' => false]);
}

function getallusers (){
    $conn = Connectdatabase();
    $stmt =$conn ->prepare("select * from users");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo $result;
    echo json_encode(["msg"=>$result]);
}


$router->get("/all",'getallusers');
$router->post("/",'posttest');

