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

if (empty($_POST['state_name']) || (empty($_POST['district']))) {
    $response['success'] = false;
    $response['message'] = "State Name or district is Empty";
    print_r(json_encode($response));
    return false;
}

$state_name = $db->escapeString($_POST['state_name']);
$district = $db->escapeString($_POST['district']);

// Query to get a list of distinct districts based on the provided bank_name
$sql = "SELECT  *
        FROM tbl_pincode p
        JOIN tbl_states s ON p.states_id = s.states_id
        WHERE s.state_name = '$state_name'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);

if ($num >= 1) {
    $rows = array();
    foreach ($res as $row) {
        $temp = array();
        $temp['pincode_id'] = $row['pincode_id'];
        $temp['district'] = $row['district'];
        $temp['area'] = $row['area'];
        $rows[] = $temp;
    }
    
    $response['success'] = true;
    $response['message'] = "District and Area List Retrieved Successfully";
    $response['data'] = $rows; // Assign the filtered array to the 'data' field
    print_r(json_encode($response));
} else {
    $response['success'] = false;
    $response['message'] = "No Districts and Area Found for the State Name";
    print_r(json_encode($response));
}
?>
