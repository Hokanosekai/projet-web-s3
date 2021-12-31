<?php

header("Access-Control-Allow-Origin: www.wordus.xyz");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");

extract($data);

if (isset($count) && !empty($count)) {

    http_response_code(200);

    print_r(json_encode($count));

} else {
    http_response_code(404);

    print_r(json_encode(array("message" => "error")));
}