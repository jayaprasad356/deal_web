<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include_once('../config/crud.php');

$db = new Database();
$db->connect();



$sql = "SELECT * FROM tbl_country";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);

if($num>=1){
 
    $response['success'] = true;
    $response['message'] = "Country Listed Successfully";
    $response['data'] = $res;
    print_r(json_encode($response));

}
else{
    $response['success'] = false;
    $response['message'] = "Data Not Found";
    print_r(json_encode($response));
}



?>