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

if (empty($_POST['state_name'])) {
    $response['success'] = false;
    $response['message'] = "State Name is Empty";
    print_r(json_encode($response));
    return false;
}

$state_name = $db->escapeString($_POST['state_name']);

// Query to get a list of distinct areas based on the provided state_name
$sql = "SELECT  *
        FROM tbl_std_code c
        JOIN tbl_state s ON c.state_id = s.state_id
        WHERE s.state_name = '$state_name'";
$db->sql($sql);
$res = $db->getResult();
$num = $db->numRows($res);

if ($num >= 1) {
    $rows = array();
    foreach ($res as $row) {
        $temp = array();
        $temp['std_code_id'] = $row['std_code_id'];
        $temp['area'] = $row['area'];
        $rows[] = $temp;
    }
    
    $response['success'] = true;
    $response['message'] = "Area List Retrieved Successfully";
    $response['data'] = $rows; // Assign the filtered array to the 'data' field
    print_r(json_encode($response));
} else {
    $response['success'] = false;
    $response['message'] = "No Area Found for the State Name";
    print_r(json_encode($response));
}
?>
