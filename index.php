<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$request = $_SERVER['REQUEST_URI'];

$parts = explode("/", $request);

$parts = array_filter($parts);

$method = $_SERVER['REQUEST_METHOD'];

$users = new Users;



if (sizeof($parts) < 2) : {
        echo json_encode([
            "status" => 404,
            "error" => "Page Not Found"
        ]);
        exit;
    }

elseif ($parts[2] === 'users' && isset($parts[3])) :

    if ($method === 'GET') : {
            if (is_numeric($parts[3])) :
                $id = $parts[3];
                $users->selectOne($id);
            else :
                echo json_encode([
                    "status" => 404,
                    "error" => "Id is Not Numeric"
                ]);
                exit;
            endif;
        }
    else :
        echo json_encode([
            "status" => 404,
            "error" => "Method Not Alloweb"
        ]);
        exit;
    endif;


elseif ($parts[2] === 'users' && sizeof($parts) == 2) : {


        switch ($method) {
            case 'GET':
                $users->selectAll();
                break;
            case 'POST':
                $users->insert();
                break;
            case 'PUT':
                $users->update();
                break;
            case 'DELETE':
                $users->delete();
                break;
            default:
                echo json_encode([
                    "status" => 404,
                    "error" => "Method Not Alloweb"
                ]);
        }
    }


elseif ($parts[2] === 'auth' && sizeof($parts) == 2) :

    if ($method === 'GET') :

        $users->auth();
    else :

        echo json_encode([
            "status" => 404,
            "error" => "Method Not Allowed"
        ]);
    endif;

else :
    echo json_encode([
        "status" => 404,
        "error" => "Page Not Found"
    ]);

endif;
