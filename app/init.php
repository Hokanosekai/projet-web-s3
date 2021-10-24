<?php

define("API_KEY_GOOGLE_MAPS", "AIzaSyBE2An2Iqh4lvRTEWxQP-DCU6--MiQYZf4");

ini_set('display_errors', 'on');
error_reporting(E_ALL);

include('core/AutoLoad.php');
AutoLoad::start();

include('core/App.php');
$app = new App();
