<?php

header("Access-Control-Allow-Origin: www.wordus.xyz");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

if (isset($data) && !empty($data['reservations'])) {

    http_response_code(200);

    print_r(json_encode($data));

} else {
    http_response_code(404);

    print_r(json_encode(array("message" => "error")));
}