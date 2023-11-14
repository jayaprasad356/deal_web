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

if (empty($_POST['bank_name'])) {
    $response['success'] = false;
    $response['message'] = "Bank Name is Empty";
    print_r(json_encode($response));
    return false;
}

$bank_name = $db->escapeString($_POST['bank_name']);

// Query to get a list of distinct districts based on the provided bank_name
$sql = "SELECT DISTINCT ic.* ,d.district_name
        FROM tbl_ifsc_code ic
        JOIN tbl_bank b ON ic.bank_id = b.bank_id
        JOIN tbl_district d ON ic.district_id = d.district_id
        WHERE b.bank_name = '$bank_name'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);

if ($num >= 1) {
    $rows = array();
    foreach ($res as $row) {
        $temp = array();
        $temp['ifsc_code_id'] = $row['ifsc_code_id'];
        $temp['district_name'] = $row['district_name'];
        $rows[] = $temp;
    }
    
    $response['success'] = true;
    $response['message'] = "District List Retrieved Successfully";
    $response['data'] = $rows; // Assign the filtered array to the 'data' field
    print_r(json_encode($response));
} else {
    $response['success'] = false;
    $response['message'] = "No Districts Found for the Bank Name";
    print_r(json_encode($response));
}
?>
