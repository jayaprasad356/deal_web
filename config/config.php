<?php
// Error Reporting Turn On
ini_set('error_reporting', E_ALL);

// Setting up the time zone
date_default_timezone_set('Asia/Kolkata');

// Host Name
$dbhost = 'localhost';

// Database Name
$dbname = 'u762811021_deal';

// Database Username
$dbuser = 'u762811021_deal';

// Database Password
$dbpass = 'Deal@2023';

// Defining base url
define("BASE_URL", "https://ifscfinder.in/");

// Getting Admin url

define("ADMIN_URL", BASE_URL . "admin" . "/");
define("MICR_URL", BASE_URL . "micr-code" . "/");
define("PIN_URL", BASE_URL . "pin-code" . "/");
define("SWIFT_URL", BASE_URL . "swift-code" . "/");


// -- Add $homepageTitle value to page's title at the end
$appendHomepageTitle = false; // false = off; true = on

// -- Show suggestions like banks, states, districts, branches when not selected on homepage
$showSuggestions = true; // false = off; true = on

// -- Search page
$numberOfRecordsPP = 20; // total number of records to show per page on search page
$showBankNamesDropdown = true; // show bank names in a dropdown with the search field

// -- Log errors, if any, in error_log file
error_reporting(0); // 0 = off; 1 = on

// 

$dbconn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $ex ) {
    echo "Connection error :" . $ex->getMessage();
}