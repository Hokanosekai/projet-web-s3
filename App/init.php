<?php

namespace App;

define("API_KEY_GOOGLE_MAPS", "AIzaSyBE2An2Iqh4lvRTEWxQP-DCU6--MiQYZf4");

ini_set('display_errors', 'on');
error_reporting(E_ALL);

include('Core/AutoLoad.php');
\App\Core\AutoLoad::start();

include('Core/App.php');
$app = new \App\Core\App();
